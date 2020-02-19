<?php 
require_once 'views/admin/View.php';

class LoginController
{

    private $usersManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->login();
        }
    }

    private function login()
    {
        $this->usersManager = new UsersManager();
        $admins = $this->usersManager->getAdmins();
        
        if (!empty($_POST['login']) && !empty($_POST['password'])) {

            if(password_verify($_POST['password'], $admins[0]->password())) {
                $_SESSION['connected'] = 1;
                $_SESSION['userName'] = $admins[0]->firstName();
                header('Location: admin.php?url=dashboard');
                exit();
            } else {
                $this->view = new View('login');
                $error = 'Login ou mot de passe incorrect';
                $this->view->generate(array('error' => $error));
            }
        } else {
            $_SESSION['connected'] = 0;
            $error = null;
            $this->view = new View('login');
            $this->view->generate(array('error' => $error));
        }
    }
}