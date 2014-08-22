<?php

class Database
{

    private static $dbConnect = '';

    private static $hasConnected = 'no';

    public static $dbType = 'mysqli';

    public static $tableName = '';

    public static $fieldList = array();

//    private static $outConnect = '';


    public function __set($varName = '', $varValue = '')
    {
        $this->fieldList[$varName] = $varValue;
    }


    //  Object-Relational Mapping (ORM)

    public function connectORM($dbOject)
    {
        $this->dbConnect = $dbOject;
        $this->hasConnected = 'yes';
    }

    private function setTableName($tableName = '')
    {
        $this->tableName = $tableName;
    }

    public function Table($tableName = '')
    {

        $db = new Database();

        $db->connectORM(self::$dbConnect);

//        self::$dbConnect = '';
//        self::$hasConnected = 'no';

//        $db->setTableName($tableName);

        $db->tableName = $tableName;

        $db->dbType = self::$dbType;


        return $db;

    }

    public function InsertOnSubmit()
    {

        $fieldList = $this->fieldList;

        $tableName = $fieldList['tableName'];

        unset($fieldList['dbConnect'], $fieldList['hasConnected'], $fieldList['tableName'], $fieldList['dbType'], $fieldList['error']);


        $listFieldNames = array_keys($fieldList);

        $listFieldValues = array_values($fieldList);

        $mergeField = implode(',', $listFieldNames);

        $mergeValue = "'" . implode("','", $listFieldValues) . "'";

        $quertStr = "insert into $tableName($mergeField) values($mergeValue)";

        $this->ORMquery($quertStr);

        $this->refreshORMConnect();

        $insert_id=$this->ORMinsert_id();

        return $insert_id;
    }

    public function SubmitChanges()
    {
        $fieldList = $this->fieldList;

        $tableName = $fieldList['tableName'];

        $setWhere = $this->genWhere();

        unset($fieldList['dbConnect'], $fieldList['hasConnected'], $fieldList['tableName'], $fieldList['dbType'], $fieldList['whereName'], $fieldList['whereValue'], $fieldList['error']);


        $listFieldNames = array_keys($fieldList);

        $listFieldValues = array_values($fieldList);

        $totalField = count($listFieldNames);

        $setFields = '';

        for ($i = 0; $i < $totalField; $i++) {
            $setFields = $setFields . $listFieldNames[$i] . "='" . $listFieldValues[$i] . "', ";

        }

        $setFields = substr($setFields, 0, strlen($setFields) - 2);

        $quertStr = "update $tableName set $setFields where $setWhere";

        $this->ORMquery($quertStr);

        $this->refreshORMConnect();

    }

    public function refreshORMConnect()
    {
        $listTMP = array(

            'dbConnect' => $this->fieldList['dbConnect'],
            'hasConnected' => $this->fieldList['hasConnected'],
            'dbType' => $this->fieldList['dbType']

        );

        $this->fieldList = $listTMP;
    }

    public function where($fieldName = '', $fieldValue = '')
    {
        if (is_array($fieldName)) {
            $totalField = count($fieldName);

            $listKeyNames = array_keys($fieldName);

            for ($i = 0; $i < $totalField; $i++) {

                $fName = $listKeyNames[$i];

                $this->where[$fName] = $fieldName[$fieldValue];

            }


        } else {
            $this->where[$fieldName] = $fieldValue;
        }


//        $this->whereName = $fieldName;
//        $this->whereValue = $fieldValue;

        return $this;
    }

    private function genWhere()
    {
        $totalField = count($this->where);

        $listKeyNames = array_keys($this->where);

        $listKeyValues = array_values($this->where);

        $strWhere = '';

        for ($i = 0; $i < $totalField; $i++) {
            $strWhere .= $listKeyNames[$i] . "='" . $listKeyValues[$i] . "' AND ";
        }

        $strWhere = substr($strWhere, 0, strlen($strWhere) - 4);

        return $strWhere;

    }

    public function DeleteOnSubmit()
    {
        $fieldList = $this->fieldList;

        $tableName = $fieldList['tableName'];

        $setWhere = $this->genWhere();

        unset($fieldList['dbConnect'], $fieldList['hasConnected'], $fieldList['tableName'], $fieldList['dbType'], $fieldList['whereName'], $fieldList['whereValue'], $fieldList['error']);

        $quertStr = "delete from $tableName where $setWhere";

        $this->ORMquery($quertStr);

        $this->refreshORMConnect();
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

    public function ORMquery($queryStr = '', $objectStr = '')
    {
//        $this->dbType='mysqli';

        switch ($this->fieldList['dbType']) {
            case "mysqli":

                $conn = $this->fieldList['dbConnect'];

                $queryDB = $conn->query($queryStr);

                $this->error = $conn->error;

//                $conn->query($queryStr);

                if (is_object($objectStr)) {
                    $objectStr($queryDB);
                }

                return $queryDB;

                break;

            case "mysql":


                break;
        }

    }

    public function query($queryStr = '', $objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $queryDB = self::$dbConnect->query($queryStr);

                $this->error = self::$dbConnect->error;

                if (is_object($objectStr)) {
                    $objectStr($queryDB);
                }

                return $queryDB;

                break;

            case "mysql":


                break;
        }

    }

    public function fetch_assoc($queryDB, $objectStr = '')
    {
        switch (self::$dbType) {
            case "mysqli":

                $row = $queryDB->fetch_assoc();

                if (is_object($objectStr)) {
                    $objectStr($row);
                }

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

        }

    }

    public function ORMinsert_id($objectStr = '')
    {
        switch ($this->fieldList['dbType']) {
            case "mysqli":

                $id = $this->fieldList['dbConnect']->insert_id;

                if (is_object($objectStr)) {
                    $objectStr($id);
                }

                return $id;

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

    public function selectDabatase($dbsortName = 'default')
    {

    }


}


?>