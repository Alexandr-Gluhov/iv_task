<?php
class UserLogic
{
    public static function signUp(
        string $email,
        string $name,
        string $birth_date,
        string $sex,
        int $blood_type,
        string $factor,
        string $password1,
        string $password2
    ): array {

        $errors = [];

        if (empty($name)) {
            $errors[] = "Введите имя";
        }

        if (empty($birth_date)) {
            $errors[] = "Введите дату рождения";
        }

        if (empty($sex)) {
            $errors[] = "Введите пол";
        }

        if (empty($blood_type)) {
            $errors[] = "Введите группу крови";
        }

        if (empty($factor)) {
            $errors[] = "Введите резус-фактор";
        }

        if (empty($password1) || empty($password2)) {
            $errors[] = "Введите пароль";
        }

        if (UserTable::getByEmail($email) !== null) {
            $errors[] = "Пользователь с данным email уже зарегистрирован";
        }

        if (empty($email)) {
            $errors[] = "Введите email";
        }
        elseif (!preg_match("/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
            $errors[] = "email невалиден";
        }

        if ($password1 !== $password2) {
            $errors[] = "Пароли не совпадают";
        }

        if (!preg_match("/.{7,}/", $password1) || !preg_match('/[a-z]/', $password1) || !preg_match('/[A-Z]/', $password1) || !preg_match('/[!?_-]/', $password1) || !preg_match('/\d/', $password1)) {
            $errors[] = "Пароль не удовлетворяет требованиям безопасности. Пароль должен содержать: маленькие и большие буквы латинского алфавита, цифры и особые символы (любой из !?_-), а также быть не менее 7 символов";
        }

        if (count($errors) === 0) {
            UserTable::create($email, $name, $birth_date, $sex, $blood_type, $factor, $password1);
        }

        return $errors;
    }

    public static function signIn(string $email, string $password): string
    {
        if (static::isAuthorized()) {
            return "Вы уже авторизованы";
        }

        $user = UserTable::getByEmail($email);
        if (null === $user) {
            return "Пользователь с таким email не найден";
        }
        
        if (!password_verify($password . $user['salt'], $user['password'])) {
            return 'Неверно указан пароль';
        }

        $_SESSION['USER_ID'] = $user['id'];

        return '';
    }

    public static function signOut()
    {
        unset($_SESSION['USER_ID']);
    }

    public static function isAuthorized(): bool
    {
        return isset($_SESSION['USER_ID']);
    }

    public static function current(): array
    {
        if (!static::isAuthorized()) {
            return null;
        }

        return UserTable::getById($_SESSION['USER_ID']);
    }
}
