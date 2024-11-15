<?php
class AppointmentTable {
    public static function set_user(int $appointment_id, int $user_id) {
        $stmt = Database::prepare('UPDATE `appointments`
                                   SET user_id = :user_id
                                   WHERE id = :id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':id', $appointment_id);
        $stmt->execute();
    }
    public static function unset_user(int $appointment_id) {
        $stmt = Database::prepare('UPDATE `appointments`
                                   SET user_id = NULL
                                   WHERE id = :id');
        $stmt->bindParam(':id', $appointment_id);
        $stmt->execute();
    }
    public static function get_appointment(int $id) {
        $stmt = Database::prepare('SELECT *
                                   FROM `appointments`
                                   WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}