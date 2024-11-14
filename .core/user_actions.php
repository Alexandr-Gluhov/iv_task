<?php

class UserActions
{
    public static function signIn() : string {

        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return '';
        }

        if ('signin' != $_POST['action']) {
            return '';
        }

        $error = UserLogic::signIn(
            $_POST['email'], $_POST['password']
        );

        if (!$error) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=y');
            die();
        }

        return $error;
    }

    public static function signUp() : array {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return [];
        }

        if ('signup' != $_POST['action']) {
            return [];
        }

        $errors = UserLogic::signUp(
            $_POST['email'], $_POST['name'], $_POST['birth_date'], $_POST['sex'], $_POST['blood_type'], $_POST['factor'], $_POST['password'], $_POST['password_confirm']
        );

        if(!count($errors)) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=y');
            die();
        }

        return $errors;
    }
}