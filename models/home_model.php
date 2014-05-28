<?php

class Home_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function delNew($id)
    {
        $id = filterVar($id);
        return $this->db->runQuery('DELETE FROM ' . NEWS_TABLE . ' WHERE newID = ' . $id);
    }

    public function addNew($newName, $newAuthor, $newDate, $newText)
    {
        return $this->db->runQuery('INSERT INTO ' . NEWS_TABLE . ' (newName, newAuthor, newDate, newText) VALUES ("' . $newName . '", "' . $newAuthor . '", "' . $newDate . '", "' . $newText . '")');
    }

    public function editNew($newName, $newText, $id, $updateDate)
    {
        return $this->db->runQuery('UPDATE ' . NEWS_TABLE . ' SET newName = "' . $newName . '", newText = "' . $newText . '", newDate = "' . $updateDate . '" WHERE newID = ' . $id);
    }

    public function editForm($id)
    {
        return $this->db->runQuery('SELECT * FROM ' . NEWS_TABLE . ' WHERE newID = ' . $id);
    }

    public function cntNews()
    {
        return $this->db->runQuery('SELECT COUNT(newID) AS allRows FROM ' . NEWS_TABLE);
    }

    public function getPages($startpoint, $max)
    {
        return $this->db->runQuery("SELECT * FROM " . NEWS_TABLE . " ORDER BY newID DESC LIMIT {$startpoint},{$max}");
    }

}
