<?php 
require_once 'views/admin/View.php';

class UsersController
{

    private $usersManager;
    private $view;

    public function __construct()
    {
        $this->users();
    }

    private function users()
    {
        if (isset($userLogin) && isset($userPassword)) {
            $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $affectedUser = $this->usersManager->setNewUser($_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['role']);
            

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