<?php
class SpecialistTable {
    public static function get_all() {
        $stmt = Database::query("SELECT * FROM `specialists`");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}