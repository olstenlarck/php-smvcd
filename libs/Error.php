<?php

class Error
{
    public function errors($name, $include = false)
    {
        if ($include == true) {
            require('views/errors/' . $name . '.php');
        } else {
            require 'views/header.php';
            require 'views/errors/' . $name . '.php';
            require 'views/footer.php';
        }
    }

}
