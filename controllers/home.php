<?php

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNews()
    {
        $this->loadModel('home');
        $this->newsMax = $this->maxNews();
        $paging = new Pag(NEWS_PER_PAGE, $this->newsMax);


        $this->query = $this->model->getPages($paging->limit['first'], $paging->limit['second']);
        while ($row = sqlFetchRow($this->query)) {
            $this->data = array();
            $text = $row['newText'];
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
            $text = str_replace('[url]', '<a href="', $text);
            $text = str_replace('[/url]', '"></a>', $text);
            $text = str_replace('[img]', '<img src="', $text);
            $text = str_replace('[/img]', '" />', $text);
            $this->data['id'] = $row['newID'];
            $this->data['newName'] = $row['newName'];
            $this->data['newAuthor'] = $row['newAuthor'];
            $this->data['newDate'] = $row['newDate'];
            $this->data['newText'] = $text;

            $this->data['newsMax'] = $this->newsMax;

            if (mysql_num_rows($this->query) == 0) {
                $this->data['noNews'] = 1;
            }
            $this->view->data[] = $this->data;
        }


        $this->view->render('home/index', array(
            'WEBSITE_TITLE' => 'Управлявай сайта си с удоволствие | SMVC.BG',
            'WEBSITE_URL' => 'http://unitecore.tk/SMVCD/index.php',
            'WEBSITE_DESC' => 'Управление за Вашия уеб сайт - бързо и лесно със SKiLLeR Model View Controller. Бърза и лека система за управление на съдържанието. Бързоразвиваща се, стремяща се да предложи по-доброто.',
            'HEADER_TITLE' => 'SKiLLeR Model View Controller',
            'HEADER_SLOGAN' => 'Лека и бърза система за Вашият уеб сайт.',
                )
        );
    }

    public function addNew()
    {
        if (Session::getSess('userGroup') == 1) {
            if (Session::getSess('logged') !== true) {
                echo 'Трябва да сте вписан';
            } else {
                $this->loadModel('home');
                if (isset($_POST['add'])) {
                    $newName = filterVar($_POST['newName']);
                    $newText = filterVar($_POST['newText']);
                    $newAuthor = Session::getSess('userName');
                    $newDate = time();
                    if (empty($newName) || empty($newText)) {
                        $this->view->render('errors/emptyInput', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
                    } else {
                        $this->model->addNew($newName, $newAuthor, $newDate, $newText);
                        if (!mysql_error()) {
                            header('Location: index.php');
                        } else {
                            $this->view->render('errors/invalidInput', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
                        }
                    }
                } else {
                    $this->view->render('home/add', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
                }
            }
        }
    }

    public function delNew()
    {
        if (Session::getSess('userGroup') == 1) {
            $this->loadModel('home');
            $this->query = $this->model->delNew($_GET['parameter']);
            header('Location: index.php');
        }
    }

    public function editNew($id)
    {
        if (Session::getSess('userGroup') == 1) {
            $id = filterVar($id);
            $this->loadModel('home');
            if (isset($_POST['edit'])) {
                $newName = filterVar($_POST['newName']);
                $newText = filterVar($_POST['newText']);
                $updateDate = time();
                if (empty($newName) || empty($newText)) {
                    $this->view->render('errors/emptyInput', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
                } else {
                    $this->model->editNew($newName, $newText, $id, $updateDate);
                    if (!mysql_error()) {
                        header('Location: index.php');
                    } else {
                        $this->view->render('errors/invalidInput', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
                    }
                }
            } else {
                $this->query = $this->model->editForm($id);
                while ($row = sqlFetchRow($this->query)) {
                    $this->data = array();
                    $this->data['newID'] = $row['newID'];
                    $this->data['newName'] = $row['newName'];
                    $this->data['newText'] = $row['newText'];
                    $this->view->data[] = $this->data;
                }
                $this->view->render('home/edit', array("WEBSITE_TITLE" => "Управлявай сайта си с удоволствие | SMVC.BG"));
            }
        }
    }

    public function errorControl()
    {
        $err = new Error();
        $err->errors('page404');
    }

    public function maxNews()
    {
        $this->query = $this->model->cntNews();
        $maxNewsRows = sqlFetchRow($this->query);
        return $maxNewsRows['allRows'];
    }

    public function getParam($param)
    {
        $param = filterVar($param);
        if (isset($param) && ($param <= 0 || strlen($param) > 2)) {
            header("Location: index.php");
        } elseif (!isset($param) || $param >= 1 || strlen($param) <= 2) {
            return $param;
        }
    }

}
