<?php

class User_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserData($userName)
    {
        return $this->db->runQuery('SELECT * FROM ' . USERS_TABLE . ' WHERE userName = "' . $userName . '"');
    }

    public function selectData($all = false, $INDB, $selected)
    {
        if ($all === false) {
            return $this->db->runQuery('SELECT * FROM ' . USERS_TABLE . ' WHERE ' . $INDB . ' = "' . $selected . '"');
        } else {
            return $this->db->runQuery('SELECT ' . $all . ' FROM ' . USERS_TABLE . ' WHERE ' . $INDB . ' = "' . $selected . '"');
        }
    }

    public function setUserData($userName, $userPass, $userEmail, $userRegDate, $userIP, $userGroup)
    {
        return $this->db->runQuery('INSERT INTO ' . USERS_TABLE . ' (userName, userPass, userEmail, userRegDate, userIP, userGroup)  VALUES ("' . $userName . '", "' . md5($userPass) . '", "' . $userEmail . '", "' . $userRegDate . '", "' . $userIP . '", "' . $userGroup . '")');
    }

    public function checkLogin($userName, $userPass)
    {
        return $this->db->runQuery('SELECT * FROM ' . USERS_TABLE . ' WHERE userName = "' . $userName . '" AND userPass = "' . md5($userPass) . '"');
    }

    public function getUsers($max)
    {
        return $this->db->runQuery('SELECT * FROM ' . USERS_TABLE . ' ORDER BY userRegDate DESC LIMIT ' . $max . '');
    }

    public function changePass($sessUserName, $userRepass)
    {
        return $this->db->runQuery('UPDATE ' . USERS_TABLE . ' SET userPass = "' . md5($userRepass) . '" WHERE userName = "' . $sessUserName . '"');
    }

    public function checkEmail($userEmail)
    {
        return $this->db->runQuery('SELECT * FROM ' . USERS_TABLE . ' WHERE userEmail = "' . $userEmail . '"');
    }

    public function setNewPassword($newPassword, $userEmail)
    {
        return $this->db->runQuery('UPDATE ' . USERS_TABLE . ' SET userPass = "' . md5($newPassword) . '" WHERE userEmail = "' . $userEmail . '"');
    }

    public function sendEmailPassword($userEmail, $title, $message)
    {
        return mail($userEmail, $title, $message);
    }

}
