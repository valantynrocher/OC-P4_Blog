<?php 
require_once 'views/admin/View.php';

class UsersController
{

    private $usersManager;
    private $view;

    public function __construct()
    {
        $this->users($_POST['first_name'], $_POST['last_name'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['role']);
    }

    private function users($userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        
        if (isset($userLogin) && isset($userPassword)) {
            $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $affectedUser = $this->usersManager->setNewUser($userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, $userRole);
            

            if ($affectedUser === false) {
                throw new Exception("Impossible d'ajouter l'utilisateur");
            }
        }
        $this->usersManager = new UsersManager();
        $users = $this->usersManager->getAllUsers();

        $this->view = new View('users');
        $this->view->generate(array('users' => $users));
    }
}