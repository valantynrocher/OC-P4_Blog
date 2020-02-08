<?php 
require_once 'views/admin/View.php';

class UsersController {

    private $_usersManager;
    private $_view;

    public function __construct() {

        $this->users();
    }

    private function users() {
        
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $affectedUser = $this->_usersManager->addUser($_POST['first_name'], $_POST['last_name'], $_POST['login'], $hashPassword, $_POST['email'], $_POST['role']);

            if ($affectedUser === false) {
                throw new Exception("Impossible d'ajouter l'utilisateur");
            }
        }
        $this->_usersManager = new UsersManager();
        $users = $this->_usersManager->allUsers();

        $this->_view = new View('users');
        $this->_view->generate(array('users' => $users));
    }
}