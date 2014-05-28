<?php

class Session
{
    public static function startSess()
    {
        session_start();
        ob_start();
    }

    public static function setSess($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function getSess($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function destroySess()
    {
        session_destroy();
    }

}
