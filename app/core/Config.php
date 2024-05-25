<?php
class Config {
    const DB_HOST = 'sql208.infinityfree.com';
    const DB_USER = 'if0_36572271';
    const DB_PASS = '112233hbjkh';
    const DB_NAME = 'if0_36572271_dbcardeal';

    public static function db_connect() {
        return new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }
    
}
?>