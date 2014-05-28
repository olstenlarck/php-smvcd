<?php

class Model
{
    public function __construct()
    {
        $this->db = new MySQL(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public static function mode()
    {
        // $dTPL = $this->db->runQuery('SELECT * FROM ' . CONFIG_TABLE . ' WHERE sys_default_temp = "default"');
        // if(!mysql_error()) {
        // return true;
        // } else {
        // return false;
        // }

        echo "test";
    }

}
