<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/.core/index.php');

if (!UserLogic::isAuthorized()) {
    header('Location: /iv_task/authentication/login.php');
    die();
}

$action_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action_error = '';
    if (isset($_POST['add_to_appointment'])) {
        $action_error .= AppointmentAction::set_user();
    }
    if (isset($_POST['delete_appointment'])) {
        $action_error .= AppointmentAction::unset_user();
    }

    if (empty($action_error)) {
        $getParams = '';

        if (count($_GET)) {
            $getParams = '?' . implode('&', array_map(fn($key, $value) => "$key=$value", array_keys($_GET), $_GET));
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . $getParams);
    }
}

$sql = 'SELECT a.id AS appointment_id, s.name AS specialist, d.name AS doctor_name, DATE_FORMAT(r.hour, "%d.%m.%Y") AS date, DATE_FORMAT(r.hour, "%H:%i") AS time, a.user_id
        FROM `appointments` a
        INNER JOIN `doctors` d
        ON d.id = a.doctor_id
        INNER JOIN `specialists` s
        ON s.id = d.specialist_id
        INNER JOIN `reception_hours` r
        ON r.id = a.reception_hour_id
        ';

$conditions = [];
$bindings = [];

if (isset($_GET['specialist']) && $_GET['specialist'] !== '') {
    $conditions[] = 's.id = :specialist';
    $bindings[':specialist'] = $_GET['specialist'];
}

if (isset($_GET['date']) && $_GET['date'] !== '') {
    $conditions[] = 'r.hour BETWEEN STR_TO_DATE(:date, "%d.%m.%Y") AND STR_TO_DATE(:date, "%d.%m.%Y") + INTERVAL 1 DAY';
    $bindings['date'] = $_GET['date'];
}

if (!empty($conditions)) {
    $sql .= 'WHERE ' . implode(' AND ', $conditions) . "\n";
}

$sql .= 'ORDER BY r.hour, a.id';

$stmt = Database::prepare($sql);
$stmt->execute($bindings);
