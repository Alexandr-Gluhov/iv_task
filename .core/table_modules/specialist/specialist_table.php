<?php
class SpecialistTable {
    public static function getAll() {
        $stmt = Database::query("SELECT * FROM `specialists`");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}