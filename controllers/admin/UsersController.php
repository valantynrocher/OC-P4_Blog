<?php 
require_once 'views/admin/View.php';

class UsersController
{

    private $usersManager;
    private $view;

    public function __construct()
    {
        $this->usersManager = new UsersManager();

        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listUsers();
                break;
            case 'create':
                $this->createUser();
                break;
            case 'insert':
                if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email'])) {
                    $this->insertUser($_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['role']);
                } else {
                    throw new Exception('Action impossible. Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'edit':
                if (isset($_GET['userId'])) {
                    $this->editUser($_GET['userId']);
                } else {
                    throw new Exception('Action impossible. Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'update':
                if (isset($_GET['userId']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email'])) {
                    $this->updateUser($_GET['userId'], $_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['role']);
                } else {
                    throw new Exception('Action impossible. Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'delete':
                if (isset($_GET['userId'])) {
                    $this->deleteUser($_GET['userId']);
                } else {
                    throw new Exception('Action impossible. Des données n\'ont pas pu être récupérées');
                }
                break;
            default:
                throw new Exception('Action inconnue');
        }

    }

    private function listUsers()
    { 
        $admins = $this->usersManager->getAdminUsers();
        $readers = $this->usersManager->getReaderUsers();

        $this->view = new View('users/listUsers');
        $this->view->generate(array('admins' => $admins, 'readers' => $readers));
    }

    private function createUser()
    {
        $this->view = new View('users/createUser');
        $this->view->generate(array());
    }

    private function insertUser($userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        $affectedUser = $this->usersManager->setNewUser($userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, $userRole);

        if ($affectedUser === false) {
            throw new Exception("Impossible d'ajouter l'utilisateur");
        } else {
            header('Location: admin.php?url=users&action=list');
            exit();
        }
    }

    private function editUser($userId)
    {
        $userToUpdate = $this->usersManager->getOneUser($userId);

        $this->view = new View('users/editUser');
        $this->view->generate(array('userToUpdate' => $userToUpdate));
    }

    private function updateUser($userId, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {

        $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        
        $affectedUser = $this->usersManager->setChangedUser($userId, $userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, $userRole);

        if($affectedUser === false) {
            throw new Exception("Impossible de mettre à jour l\'utilisateur !");
        } else  {
            header('Location: admin.php?url=users&action=list');
            exit();
        }
    }

    private function deleteUser($userId)
    {
        $deletedUser = $this->usersManager->setUserDeleted($userId);

        if($deletedUser === false) {
            throw new \Exception("Impossible de supprimer l\'utilisateur !");
        } else {
            header('Location: admin.php?url=users&action=list');
            exit();
        }
    }
}