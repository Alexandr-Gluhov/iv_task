<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/.core/index.php');
$stmt = Database::query('SELECT s.name AS specialist, d.name AS doctor_name, DATE_FORMAT(r.hour, "%d.%m.%Y") AS date, DATE_FORMAT(r.hour, "%H:%i") AS time, a.user_id
                 FROM `appointments` a
                 INNER JOIN `doctors` d
                 ON d.id = a.doctor_id
                 INNER JOIN `specialists` s
                 ON s.id = d.specialist_id
                 INNER JOIN `reception_hours` r
                 ON r.id = a.reception_hour_id
                ');
$stmt->execute();                    

