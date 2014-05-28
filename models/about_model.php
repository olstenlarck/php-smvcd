<?php

class About_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAbout()
    {
        return $this->db->runQuery('SELECT * FROM ' . ABOUT_TABLE);
    }

    public function editAbout($abText, $abDate)
    {
        return $this->db->runQuery('UPDATE ' . ABOUT_TABLE . ' SET abText = "' . $abText . '", abDate = "' . $abDate . '"');
    }

}
