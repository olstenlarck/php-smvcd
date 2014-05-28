<?php

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function tplmode() {
    // $this->loadModel('temp');
    // }

    public function getNews()
    {
        $this->loadModel('home');
        $this->query = $this->model->newGetListings(NEWS_PER_PAGE);
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

            if (mysql_num_rows($this->query) == 0) {
                $this->data['noNews'] = 1;
            }
            $this->view->data[] = $this->data;
        }
        $this->view->render('home/index');
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
                        $this->view->render('errors/emptyInput');
                    } else {
                        $this->model->addNew($newName, $newAuthor, $newDate, $newText);
                        if (!mysql_error()) {
                            header('Location: index.php');
                        } else {
                            $this->view->render('errors/invalidInput');
                        }
                    }
                } else {
                    $this->view->render('home/add');
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
                    $this->view->render('errors/emptyInput');
                } else {
                    $this->model->editNew($newName, $newText, $id, $updateDate);
                    if (!mysql_error()) {
                        header('Location: index.php');
                    } else {
                        $this->view->render('errors/invalidInput');
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
                $this->view->render('home/edit');
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
        if (!pageFilter($param) || $param < 0 || strlen($param) > 2) {
            header("Location: index.php");
        } else {
            return $param;
        }
    }

    public function getPageNews($limit, $getparamPages)
    {

        $startpoint = ($getparamPages - 1) * $limit;

        $this->queryGetPages = $this->model->getPages($startpoint, $limit);
        while ($newsRow = sqlFetchRow($this->queryGetPages)) {
            $this->newsData = array();
            $text = $newsRow['newText'];
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
            $this->newsData['id'] = $newsRow['newID'];
            $this->newsData['newName'] = $newsRow['newName'];
            $this->newsData['newAuthor'] = $newsRow['newAuthor'];
            $this->newsData['newDate'] = $newsRow['newDate'];
            $this->newsData['newText'] = $text;


            $this->newsData['limit'] = NEWS_PER_PAGE;
            $this->newsData['newsMax'] = $this->maxNews();

            if (mysql_num_rows($this->queryGetPages) == 0) {
                $this->data['noNews'] = 1;
            }
            $this->view->data[] = $this->newsData;
        }
        $this->view->render('home/index');
    }

    public function paginate($limit, $getparamPages, $maxNews, $url = 'index.php?pages')
    {
        $adjacents = "2";

        $start = ($page - 1) * $limit;

        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($maxNews / $limit);
        $lpm1 = $lastpage - 1;

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination'>";
            $pagination .= "<li class='details'>Page $page of $lastpage</li>";
            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}=$counter'>$counter</a></li>";
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";
                    }
                    $pagination.= "<li class='dot'>...</li>";
                    $pagination.= "<li><a href='{$url}=$lpm1'>$lpm1</a></li>";
                    $pagination.= "<li><a href='{$url}=$lastpage'>$lastpage</a></li>";
                }
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<li><a href='{$url}=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}=2'>2</a></li>";
                    $pagination.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}=$counter'>$counter</a></li>";
                    }
                    $pagination.= "<li class='dot'>..</li>";
                    $pagination.= "<li><a href='{$url}=$lpm1'>$lpm1</a></li>";
                    $pagination.= "<li><a href='{$url}=$lastpage'>$lastpage</a></li>";
                }
                else {
                    $pagination.= "<li><a href='{$url}=1'>1</a></li>";
                    $pagination.= "<li><a href='{$url}=2'>2</a></li>";
                    $pagination.= "<li class='dot'>..</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a class='current'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href='{$url}=$counter'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}=$lastpage'>Last</a></li>";
            } else {
                $pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
            $pagination.= "</ul>\n";
        }


        return $pagination;
    }

}
