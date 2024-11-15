<?php
class AppointmentLogic {
    public static function set_user(int $appointment_id, int $user_id) {
        $current_user = AppointmentTable::get_appointment($appointment_id);
        if ($current_user === null || empty($current_user)) {
            return 'Записи не существует';
        }
        $current_user_id = $current_user['user_id'];
        if ($current_user_id !== '' && $current_user_id !== null) {
            return 'Запись не свободна';
        }
        AppointmentTable::set_user($appointment_id, $user_id);
    }
    public static function unset_user(int $appointment_id) {
        $current_user = AppointmentTable::get_appointment($appointment_id);
        if ($current_user === null || empty($current_user)) {
            return 'Записи не существует';
        }
        $current_user_id = $current_user['user_id'];
        if ($current_user_id !== $_SESSION['USER_ID']) {
            return 'Запись не принадлежит текущему пользователю';
        }
        AppointmentTable::unset_user($appointment_id);
    }
}