<?php
class ReceptionHourTable {
    public static function getAllDaysFromNow() {
        $stmt = Database::query('SELECT DATE_FORMAT(hour, "%d.%m.%Y") AS date
                                 FROM `reception_hours`
                                 WHERE hour >= CURDATE()
                                 GROUP BY DATE(hour)
                                 ');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}