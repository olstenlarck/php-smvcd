<?php

class TPL_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return $this->db->runQuery('SELECT * FROM ' . CONFIG_TABLE);
    }

    public function tplDefault()
    {
        // WHERE sys_default_temp = "default"'
    }

}
