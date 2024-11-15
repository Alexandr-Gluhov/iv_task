<?php
class AppointmentAction {
    public static function set_user() {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        if (!isset($_POST['add_to_appointment']) || !isset($_SESSION['USER_ID'])) {
            return;
        }

        AppointmentLogic::set_user(intval($_POST['add_to_appointment']), intval($_SESSION['USER_ID']));
    }

    public static function unset_user() {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        if (!isset($_POST['delete_appointment']) || !isset($_SESSION['USER_ID'])) {
            return;
        }

        AppointmentLogic::unset_user(intval($_POST['delete_appointment']));
    }
}