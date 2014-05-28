<?php

class Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function loadModel($name)
    {

        $name = strtolower($name);

        $path = 'models/' . $name . '_model.php';
        $path = strtolower($path);

        if (file_exists($path)) {
            require($path);

            $modelName = $name . '_model';

            $this->model = new $modelName;
        }
    }

}
