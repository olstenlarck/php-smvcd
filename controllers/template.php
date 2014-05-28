<?php

class Template extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function temp()
    {
        $this->loadModel('tpl');
        $this->query = $this->model->getDefault();
        while ($row = sqlFetchRow($this->query)) {
            $this->dataTPL = array();
            $this->dataTPL['tempID'] = $row['sys_temp_id'];
            $this->dataTPL['tempName'] = $row['sys_temp_name'];
            $this->dataTPL['tempDefault'] = $row['sys_default_temp'];
            if (mysql_num_rows($this->query) == 1) {
                $this->view->render('header');
            }
            $this->view->dateTemp[] = $this->dataTPL;
        }
    }

}
