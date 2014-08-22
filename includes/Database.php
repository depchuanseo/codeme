<?php

class Database
{

    private static $dbConnect = '';

    private static $hasConnected = 'no';

    public static $dbType = 'mysqli';

    public static $tableName = '';

//    public static $fieldList = array();

    public static $error;


//
//    public function __set($varName = '', $varValue = '')
//    {
//        $this->fieldList[$varName] = $varValue;
//    }


    //  Object-Relational Mapping (ORM)

    public function table($tableName = '')
    {

        $db = new DatabaseORM();

        $db->tableName = $tableName;

        return $db;

    }

    //  Object-Relational Mapping (ORM)


    public function connect($dbsortName = 'default')
    {
        global $db;

        if (self::$hasConnected == 'no') {

            if (!is_array($db[$dbsortName])) return false;

            self::$dbType = $db[$dbsortName]['dbtype'];

            switch ($db[$dbsortName]['dbtype']) {
                case "mysqli":

                    $conn = new mysqli($db[$dbsortName]['dbhost'], $db[$dbsortName]['dbuser'], $db[$dbsortName]['dbpassword'], $db[$dbsortName]['dbname'], $db[$dbsortName]['dbport']);

//                    if (!$conn) Alert::make('Cant connect to your database.');


                    self::$dbConnect = $conn;

                    self::$hasConnected = 'yes';

                    return $conn;

                    break;


                case "sqlserver":

                    $conn = DatabaseSqlserver::connect();

                    self::$error = DatabaseSqlserver::$error;

                    break;

//                case "mysql":
//
//                    $conn = mysql_connect($db['dbhost'], $db['dbuser'], $db['dbpassword']);
//
//                    mysql_select_db($db['dbname']);
//
//                    self::$dbConnect = $conn;
//
//                    self::$hasConnected = 'yes';
//
//                    break;


            }
        }

    }


    public function query($queryStr = '', $objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $queryDB = self::$dbConnect->query($queryStr);

                self::$error = self::$dbConnect->error;

                if (is_object($objectStr)) {
                    $objectStr($queryDB);
                }

                return $queryDB;

                break;

            case "sqlserver":

                $query = DatabaseSqlserver::query($queryStr, $objectStr = '');

                self::$error = DatabaseSqlserver::$error;

                return $query;

                break;
            case "mysql":


                break;
        }

    }

    public function fetch_assoc($queryDB, $objectStr = '', $fetchType = 'SQLSRV_FETCH_ASSOC')
    {
        switch (self::$dbType) {
            case "mysqli":

                $row = $queryDB->fetch_assoc();

                if (is_object($objectStr)) {
                    $objectStr($row);
                }

                return $row;

                break;

            case "sqlserver":

                $row = DatabaseSqlserver::fetch_array($queryDB, $objectStr, $fetchType);

                return $row;

                break;

        }

    }

    public function fetch_array($queryDB, $objectStr = '', $fetchType = 'SQLSRV_FETCH_ASSOC')
    {
        switch (self::$dbType) {
            case "mysqli":

                $row = $queryDB->fetch_array();

                if (is_object($objectStr)) {
                    $objectStr($row);
                }

                return $row;

                break;

            case "sqlserver":

                $row = DatabaseSqlserver::fetch_array($queryDB, $objectStr, $fetchType);

                return $row;

                break;

        }

    }

    public function num_rows($queryDB, $objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $totalRows = $queryDB->num_rows;

                if (is_object($objectStr)) {
                    $objectStr($totalRows);
                }

                return $totalRows;

                break;

            case "sqlserver":

                $totalRows = DatabaseSqlserver::num_rows($queryDB, $objectStr);

                return $totalRows;

                break;

        }

    }

    public function insert_id($objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $id = self::$dbConnect->insert_id;

                if (is_object($objectStr)) {
                    $objectStr($id);
                }

                return $id;

                break;

            case "sqlserver":

                $id = DatabaseSqlserver::insert_id($objectStr);

                return $id;

                break;

        }

    }

    public function hasError($objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $errorStr = self::$dbConnect->error;

                if (isset($errorStr[5])) {
                    if (is_object($objectStr)) {
                        $objectStr($errorStr);
                    }

                    return $errorStr;
                }

                return false;


                break;

        }
    }


}


?>