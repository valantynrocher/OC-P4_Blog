<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class UsersController extends Controller
{
    /**
     * Manager for users
     */       
    private $usersManager;

    public function __construct()
    {
        $this->usersManager = new UsersManager();
    }

    /**
     * Action 'index' (default)
     * Generates view lo list users
     */
    public function index()
    { 
        $admins = $this->usersManager->getAdminUsers();
        $readers = $this->usersManager->getReaderUsers();

        $this->generateView(array(
            'admins' => $admins,
            'readers' => $readers
        ));
    }

    /**
     * Action 'create'
     * Generates view to create new user
     */
    public function create()
    {
        $this->generateView(array());
    }

    /**
     * Action 'edit'
     * Generates view to edit one user
     */
    public function edit()
    {
        if (isset($_GET['userId'])) {
            $userToUpdate = $this->usersManager->getOneUser($_GET['userId']);

            $this->generateView(array('userToUpdate' => $userToUpdate));
        } else {
            throw new Exception($this->actionError);
        }
    }

    /**
     * Action 'insert'
     * Call Users Manager to insert new user in databse
     * Redirect on index
     */
    public function insert()
    {
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email'])) {
            $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $affectedUser = $this->usersManager->setNewUser($_POST['firstName'], $_POST['lastName'], $_POST['login'], $hashPassword, $_POST['email'], $_POST['role']);
    
            if ($affectedUser === false) {
                throw new Exception("Impossible d'ajouter l'utilisateur");
            } else {
                header('Location: admin.php?url=users');
                exit();
            }
        } else {
            throw new Exception($this->actionError);
        }
    }

    /**
     * Action 'update'
     * Call Users Manager to update one user in databse
     * Redirect on index
     */
    public function update()
    {
        if (isset($_GET['userId']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email'])) {
            $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
            $affectedUser = $this->usersManager->setChangedUser($_GET['userId'], $_POST['firstName'], $_POST['lastName'], $_POST['login'], $hashPassword, $_POST['email'], $_POST['role']);
    
            if($affectedUser === false) {
                throw new Exception("Impossible de mettre à jour l\'utilisateur !");
            } else  {
                header('Location: admin.php?url=users');
                exit();
            }
        } else {
            throw new Exception($this->actionError);
        }

    }

    /**
     * Action 'delete'
     * Call Users Manager to delete one user in databse
     * Redirect on index
     */
    public function delete()
    {
        if (isset($_GET['userId'])) {
            $deletedUser = $this->usersManager->setUserDeleted($_GET['userId']);

            if($deletedUser === false) {
                throw new \Exception("Impossible de supprimer l\'utilisateur !");
            } else {
                header('Location: admin.php?url=users');
                exit();
            }
        } else {
            throw new Exception($this->actionError);
        }
    }
}