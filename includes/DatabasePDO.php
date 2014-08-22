<?php

class DatabasePDO
{
    public static $dbConnect = '';

    public static $error = '';

    public static $insertID = 0;

    public static $protocol = 'mysql';

    public function connect()
    {
        global $db;

        self::$protocol = $db['protocol'];

        $conn = new PDO($db['protocol'] . ':host=' . $db['dbhost'] . ';dbname=' . $db['dbname'], $db['dbuser'], $db['dbpass']);

        self::$dbConnect = $conn;

        return $conn;

    }


}


?>