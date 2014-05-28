<?php

class About extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAbout()
    {
        $this->loadModel('about');
        $this->query = $this->model->getAbout();
        while ($row = sqlFetchRow($this->query)) {
            $this->data = array();
            $text = $row['abText'];
            $text = str_replace('[b]', '<b>', $text);
            $text = str_replace('[/b]', '</b>', $text);
            $text = str_replace('[strike]', '<strike>', $text);
            $text = str_replace('[/strike]', '</strike>', $text);
            $text = str_replace('[center]', '<center>', $text);
            $text = str_replace('[/center]', '</center>', $text);
            $text = str_replace('[code]', '<code>', $text);
            $text = str_replace('[/code]', '</code>', $text);
            $text = str_replace('[i]', '<i>', $text);
            $text = str_replace('[/i]', '</i>', $text);
            $text = str_replace('[u]', '<u>', $text);
            $text = str_replace('[/u]', '</u>', $text);
            $text = str_replace('[br/]', '<br/>', $text);
            $text = str_replace('[br]', '<br/>', $text);
            $text = str_replace('[url]', '<a href="', $text);
            $text = str_replace('[/url]', '">линк</a>', $text);
            $text = str_replace('[img]', '<img src="', $text);
            $text = str_replace('[/img]', '" />', $text);
            $text = str_replace('[/img]', '" />', $text);
            $this->data['abText'] = $text;
            $this->data['abDate'] = $row['abDate'];
            $this->view->data[] = $this->data;
        }

        $this->view->render('about/index');
    }

    public function editAbout()
    {
        if (Session::getSess('userGroup') == 1) {
            $this->loadModel('about');
            if (isset($_POST['edit'])) {
                $abText = filterVar($_POST['abText']);
                $abDate = time();
                if (empty($abText) || empty($abDate)) {
                    $this->view->render('errors/emptyInput');
                } else {
                    $this->model->editAbout($abText, $abDate);
                    if (!mysql_error()) {
                        header('Location: index.php?url=about&method=getAbout');
                    } else {
                        $this->view->render('errors/invalidInput');
                    }
                }
            } else {
                $this->query = $this->model->getAbout();
                while ($row = sqlFetchRow($this->query)) {
                    $this->data = array();
                    $this->data['abText'] = $row['abText'];
                    $this->view->data[] = $this->data;
                }
                $this->view->render('about/edit');
            }
        }
    }

    public function errorControl()
    {
        $err = new Error();
        $err->errors('page404');
    }

}
