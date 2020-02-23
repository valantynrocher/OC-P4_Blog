<?php 
require_once 'views/admin/View.php';

class AuthController
{
    private $usersManager;
    private $view;

    public function __construct()
    {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'login';
        }
        
        switch ($action) {
            case 'login':
                if ($_SESSION['connected'] === 0) {
                    if (!empty($_POST['userLogin']) && !empty($_POST['userPassword'])) {
                        $this->tryLogin($_POST['userLogin'], $_POST['userPassword']);
                    } else {
                        $this->firstLogin();
                    }
                } else {
                    header('Location: admin.php?url=dashboard');
                }
                break;
            case 'logout':
                $this->logout();
                break;
        }
    }

    private function tryLogin($userLogin, $userPaswword)
    {
        $this->usersManager = new UsersManager();
        $admins = $this->usersManager->getAdminUsers();
        echo 'Tentative de connexion <br>';
        print_r($admins);
        echo '<br>';
        print_r($_SESSION);
        echo '<br>';

        foreach ($admins as $admin) {
            if(password_verify($userPaswword, $admin->userPassword()) && $userLogin === $admin->userLogin()) {
                $_SESSION['connected'] = 1;
                $_SESSION['userName'] = $admin->userFirstName();
                header('Location: admin.php?url=dashboard');
                exit();
            } else {
                $this->view = new View('login');
                $error = 'Login ou mot de passe incorrect';
                echo $error;
                $this->view->generate(array('error' => $error));
            }
        }
    }

    private function firstLogin()
    {
        echo 'Page de connexion <br>';
        print_r($_SESSION);
        $_SESSION['connected'] = 0;
        $error = null;
        $this->view = new View('login');
        $this->view->generate(array('error' => $error));
    }

    private function logout()
    {
        header('Location: admin.php?url=auth&action=login');
        exit();
    }
}