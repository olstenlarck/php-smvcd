<?php

class User extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function membersList()
    {
        $this->loadModel('user');
        $this->query = $this->model->getUsers(15);
        while ($row = sqlFetchRow($this->query)) {
            $this->dataUser = array();
            $this->dataUser['userID'] = $row['userID'];
            $this->dataUser['userName'] = $row['userName'];
            $this->dataUser['userEmail'] = $row['userEmail'];
            $this->dataUser['userRegDate'] = $row['userRegDate'];
            $this->dataUser['userIP'] = $row['userIP'];
            $this->dataUser['userGroup'] = $row['userGroup'];
            if (mysql_num_rows($this->query) == 0) {
                $this->dataUser['noMembers'] = 1;
            }
            $this->view->usersData[] = $this->dataUser;
        }
        $this->view->render('user/memberslist');
    }

    public function changePassword()
    {
        if (Session::getSess('logged') === false) {
            header('Location: index.php');
        } else {
            $this->loadModel('user');
            if (isset($_POST['changePassword'])) {
                $sessUserName = Session::getSess('userName');
                $oldPass = filterVar($_POST['oldpassword']);
                $newPass = filterVar($_POST['password']);
                $newRepass = filterVar($_POST['repassword']);

                //cannot be empty field
                if (empty($newPass) || empty($newRepass) || empty($oldPass)) {
                    $this->view->render('errors/emptyInput');
                } else {
                    //get password how is in use from DB.
                    $this->getPassQuery = $this->model->getUserData($sessUserName);
                    $passRow = sqlFetchRow($this->getPassQuery);
                    $oldPassMD = md5($oldPass);

                    //if dont match, throw error msg
                    if ($oldPassMD == $passRow['userPass']) {

                        //if newpass not match with old pass, and if match with old - throw error msg
                        if (($newPass == $newRepass) && ($oldPass != $newPass)) {

                            //must be more than 4 symbols
                            if ($this->minLen($newPass) !== false && $this->minLen($newRepass) !== false) {

                                //check exist session user in db
                                $this->checkQuery = $this->model->getUserData($sessUserName);
                                if (mysql_num_rows($this->checkQuery) !== 1) {
                                    $this->view->render('errors/invalidUsername');
                                } else {
                                    //if all end good - change password in db.
                                    $this->query = $this->model->changePass($sessUserName, $newRepass);
                                    if (!mysql_error()) {
                                        $this->view->render('user/successChangePassword');
                                    }
                                }
                            } else {
                                $this->view->render('errors/shortInput');
                            }
                        } else {
                            $this->view->render('errors/donotMatch');
                        }
                    } else {
                        $this->view->render('errors/wrongOldpass');
                    }
                }
            } else {
                $this->view->render('user/changePassword');
            }
        }
    }

    public function recoverPassword()
    {
        if (Session::getSess('logged') === true) {
            header('Location: index.php');
        } else {
            $this->loadModel('user');
            $userEmail = $_POST['userEmail'];
            if (isset($_POST['submitRecoverPassword'])) {
                if (!empty($userEmail)) {
                    if (validEmail($userEmail)) {
                        if ($this->minLen($userEmail) !== false) {
                            $this->query = $this->model->checkEmail($userEmail);
                            if (mysql_num_rows($this->query) !== 1) {
                                $this->view->render('errors/notExistEmail');
                            } else {
                                $newPassword = rand(1, 1000000);
                                $this->query = $this->model->setNewPassword($newPassword, $userEmail);
                                if (!mysql_error()) {
                                    $message = "
										==============(S-MVC2 Mailer)==============\r\n
										===========================================\r\n
										A request for the password for this account has been made.\r\n
										The new password for this account is <b>$newPassword</b> .\r\n
										Please log in and change your password.\r\n
										======================================\r\n\r\n									
										Do not replay to this email!\r\n" . BLOG_TITLE . NOREPLAY_EMAIL;
                                    $this->sendEmail = $this->model->sendEmailPassword($userEmail, 'Вашата нова парола', $message);
                                    if (!mysql_error()) {
                                        $this->view->render('user/successRecoverPassword');
                                    }
                                }
                            }
                        } else {
                            $this->view->render('errors/shortInput');
                        }
                    } else {
                        $this->view->render('errors/invalidEmail');
                    }
                } else {
                    $this->view->render('errors/emptyInput');
                }
            } else {
                $this->view->render('user/recoverPassword');
            }
        }
    }

    public function viewProfile()
    {
        $this->loadModel('user');

        $profileName = filterVar($_GET['u']);
        $this->getNameQuery = $this->model->getUserData($profileName);
        while ($row = sqlFetchRow($this->getNameQuery)) {
            $this->viewUser = array();
            $this->viewUser['userName'] = $row['userName'];
            $this->viewUser['userEmail'] = $row['userEmail'];
            $this->viewUser['userRegDate'] = $row['userRegDate'];
            $this->viewUser['userIP'] = $row['userIP'];
            $this->viewUser['userGroup'] = $row['userGroup'];
            $this->viewUser['profileName'] = $profileName;
            if (mysql_num_rows($this->getNameQuery) != 0) {
                if ($profileName == $row['userName']) {
                    $this->viewUser['exist'] = 1;
                }
            }

            $this->view->profileView[] = $this->viewUser;
        }
        $this->view->render('user/viewProfile');
    }

    public function regUser()
    {
        if (Session::getSess('logged') === true) {
            header('Location: index.php');
        } else {
            $this->loadModel('user');
            if (isset($_POST['register'])) {
                $regName = filterVar($_POST['regName']);
                $regEmail = validEmail($_POST['regEmail']);
                $regPass = filterVar($_POST['regPass']);
                $regRePass = filterVar($_POST['regRePass']);
                $userRegDate = time();
                $userIP = $_SERVER['REMOTE_ADDR'];

                //cannot be empty field
                if (!empty($regName) && !empty($regEmail) && !empty($regPass) && !empty($regRePass)) {

                    if ($regPass == $regRePass) {

                        //must be more than 4 symbols
                        if ($this->minLen($regName) !== false && $this->minLen($regEmail) !== false && $this->minLen($regPass)) {

                            //already in use nick
                            $this->checkRegQuery = $this->model->getUserData($regName);
                            if (mysql_num_rows($this->checkRegQuery) != 1) {
                                $this->query = $this->model->setUserData($regName, $regRePass, $regEmail, $userRegDate, $userIP, 0);
                                //if not error , render to success page with whole info.
                                if (!mysql_error()) {
                                    $this->view->render('user/successRegister');
                                }
                            } else {
                                $this->view->render('errors/alreadyInUse');
                            }
                        } else {
                            echo time();
                            $this->view->render('errors/shortInput');
                        }
                    } else {
                        $this->view->render('errors/donotMatch');
                    }
                } else {
                    $this->view->render('errors/emptyInput');
                }
            } else {
                $this->view->render('user/register');
            }
        }
    }

    public function logIn()
    {
        if (Session::getSess('logged') === true) {
            header('Location: index.php');
        } else {
            $this->loadModel('user');
            if (isset($_POST['login'])) {
                $userName = filterVar($_POST['username']);
                $userPass = filterVar($_POST['password']);

                //cannot be empty field
                if (empty($userName) || empty($userPass)) {
                    $this->view->render('errors/emptyInput');
                } else {

                    //must be more than 4 symbols
                    if ($this->minLen($userName) !== false && $this->minLen($userPass) !== false) {

                        //checking password and username
                        $this->checkQuery = $this->model->checkLogin($userName, $userPass);

                        //if all right - set session to TRUE.
                        if (mysql_num_rows($this->checkQuery) > 0) {
                            Session::setSess('logged', true);
                            while ($row = sqlFetchRow($this->checkQuery)) {
                                Session::setSess('userID', $row['userID']);
                                Session::setSess('userGroup', $row['userGroup']);
                                Session::setSess('userName', $row['userName']);
                            }
                            header('Location: index.php');
                        } else {
                            $this->view->render('errors/wrongPass');
                        }
                    } else {
                        $this->view->render('errors/shortInput');
                    }
                }
            } else {
                $this->view->render('user/login', array(
                    'WEBSITE_TITLE' => 'Вход за клиенти и потребители',
                    'WEBSITE_DESC' => 'Управление за Вашия уеб сайт - бързо и лесно със SKiLLeR Model View Controller. Бърза и лека система за управление на Вашия уеб сайт. Бързоразвиваща се, стремяща се да предложи по-доброто.',
                    'WEBSITE_HEADER' => 'SKiLLeR Model View Controller',
                    'WEBSITE_SLOGAN' => 'Системна поддръжка tunnckoCore. Лека и бърза система за уеб сайт.',
                    'userprofile' => 'Member Panel'
                        )
                );
            }
        }
    }

    public function logOut()
    {
        Session::destroySess();
        header('Location: index.php');
    }

    public function minLen($value)
    {
        if (strlen($value) > 4) {
            return 1;
        } else {
            $this->view->render('errors/shortInput');
            return 0;
        }
    }

    public function errorControl()
    {
        $err = new Error();
        $err->errors('page404');
    }

}
