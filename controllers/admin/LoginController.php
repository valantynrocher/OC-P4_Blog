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
        $admins = $this->usersManager->getAdminUsers();
        
        if (!empty($_POST['userLogin']) && !empty($_POST['userPassword'])) {

            if(password_verify($_POST['userPassword'], $admins[0]->userPassword())) {
                $_SESSION['connected'] = 1;
                $_SESSION['userName'] = $admins[0]->userFirstName();
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