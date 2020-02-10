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
        
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $affectedUser = $this->usersManager->addUser($_POST['first_name'], $_POST['last_name'], $_POST['login'], $hashPassword, $_POST['email'], $_POST['role']);

            if ($affectedUser === false) {
                throw new Exception("Impossible d'ajouter l'utilisateur");
            }
        }
        $this->usersManager = new UsersManager();
        $users = $this->usersManager->allUsers();

        $this->view = new View('users');
        $this->view->generate(array('users' => $users));
    }
}