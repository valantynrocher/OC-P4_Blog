<?php 
require_once 'views/admin/View.php';

class LoginController {

    private $_usersManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->login();
        }
    }

    private function login() {
        $this->_usersManager = new UsersManager();
        $admins = $this->_usersManager->getAdmins();
        
        if (!empty($_POST['login']) && !empty($_POST['password'])) {

            if(password_verify($_POST['password'], $admins[0]->password())) {
                $_SESSION['connected'] = 1;
                $_SESSION['userName'] = $admins[0]->first_name();
                header('Location: admin.php?url=dashboard');
                exit();
            }
            else {
                $this->_view = new View('login');
                $error = 'Login ou mot de passe incorrect';
                $this->_view->generate(array('error' => $error));
            }
        }
        else {
            $error = null;
            $this->_view = new View('login');
            $this->_view->generate(array('error' => $error));
        }
    }
}