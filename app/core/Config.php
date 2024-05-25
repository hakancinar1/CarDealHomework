<?php
class Config {
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'CarDealDB';

    public static function db_connect() {
        return new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }
}
?>