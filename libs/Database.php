<?php

class MySQL
{
    public function __construct($dbHost, $dbUser, $dbPass, $dbName)
    {
        $this->db_connect($dbHost, $dbUser, $dbPass, $dbName);
    }

    public function db_connect($dbHost, $dbUser, $dbPass, $dbName)
    {
        mysql_connect($dbHost, $dbUser, $dbPass) or die("Error connecting to database: " . mysql_error());
        mysql_select_db($dbName) or die("Error selecting database: " . mysql_error());
        $this->runQuery("SET NAMES UTF8");
    }

    public function runQuery($sql)
    {
        $rs = mysql_query($sql);
        if (mysql_error()) {
            echo mysql_error() . '<br/>SQL: ' . $sql;
        }
        return $rs;
    }

    public function delQuery($table, $where)
    {
        $this->runQuery('DELETE FROM ' . $table . ' WHERE ' . $where);
    }

}
