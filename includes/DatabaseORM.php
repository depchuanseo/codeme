<?php

class DatabaseORM
{
    public static $fieldList = array();

    public function __set($varName = '', $varValue = '')
    {
        $this->fieldList[$varName] = $varValue;
    }
}


?>