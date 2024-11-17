<?php
class UserTable
{
    public static function create(
        string $email,
        string $name,
        string $birth_date,
        string $sex,
        int $blood_type,
        string $factor,
        string $password
    ) {
        $query = Database::prepare(
            "INSERT INTO `users` (`email`, `name`, `birth_date`, `sex`, `blood_type`, `factor`, `password`, `salt`)
                VALUES (:email, :name, :birth_date, :sex, :blood_type, :factor, :password, :salt)"
        );

        $salt = substr(md5(time()), 0, rand(10, 20));

        $query->bindValue(":email", $email);
        $query->bindValue(":name", $name);
        $query->bindValue(":birth_date", $birth_date);
        $query->bindValue(":sex", $sex);
        $query->bindValue(":blood_type", $blood_type);
        $query->bindValue(":factor", $factor);
        $query->bindValue(":password", password_hash($password . $salt, PASSWORD_DEFAULT));
        $query->bindValue(":salt", $salt);

        if (!$query->execute()) {
            throw new PDOException('An error occurred while adding a user');
        }
    }

    public static function getByEmail(string $email): array | null
    {
        $query = Database::prepare("SELECT * FROM `users` WHERE `email` = :email");
        $query->bindValue(":email", $email);
        $query->execute();

        $users = $query->fetchAll();

        if (!count($users)) {
            return null;
        }

        return $users[0];
    }

    public static function getById(int $id) {
        $query = Database::prepare("SELECT * FROM `users` WHERE `id` = :id");
        $query->bindParam(":id", $id);
        $query->execute();

        $users = $query->fetchAll();

        if (!count($users)) {
            return null;
        }

        return $users[0];
    }
}
