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
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'account'
     * Generates the view for account edition
     * If user update his informations, call Users Manager
     * to update user in databse
     */
    public function account()
    {
        if (isset($_POST['submit'])) {
            if (isset($_GET['userId']) && isset($_POST['login']) && isset($_POST['email'])) {        
                $affectedUser = $this->usersManager->setChangedUser($_GET['userId'], $_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['email'], $_POST['role']);
        
                if($affectedUser === false) {
                    header('Location: admin.php?url=users&action=account&alert=infoError');
                    exit();
                } else  {
                    header('Location: admin.php?url=users&action=account&alert=infoSuccess');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            // Init alert params
            $alert = null;
            $errorInfosMsg = null;
            $successInfosMsg = null;
            $errorPassMsg = null;
            $successPassMsg = null;

            // Catch feedback during login or signup and set alert message
            if (isset($_GET['alert'])) {
                $alert = $_GET['alert'];
                switch($alert) {
                    case 'infoError':
                        $errorInfosMsg = 'Impossible de mettre à jour l\'utilisateur.';
                    case 'infoSuccess':
                        $successInfosMsg = 'Vos informations ont bien été mises à jour.';
                        break;
                    case 'passError':
                        $errorPassMsg = 'Les mots de passe saisis ne sont pas identiques.';
                        break;
                    case 'passUpdateError':
                        $errorPassMsg = 'Impossible de mettre à jour votre mot de passe.';
                        break;
                    case 'passSuccess':
                        $successPassMsg = 'Votre mot de passe a bien été modifié.';
                }
            }

            $this->generateView(array(
                'errorInfosMsg' => $errorInfosMsg,
                'errorPassMsg' => $errorPassMsg,
                'successInfosMsg' => $successInfosMsg,
                'successPassMsg' => $successPassMsg
            ));
        }
    }

    /**
     * Private function to update datas for Session
     * when user update his informations
     */
    private function updateSession() {
        $_SESSION['user'] = array(
            'id' => $userConnected->userId(),
            'firstName' => $userConnected->userFirstName(),
            'lastName' => $userConnected->userLastName(),
            'login' => $userConnected->userLogin(),
            'email' => $userConnected->userEmail(),
            'role' => $userConnected->userRole(),
            'creationDate' => $userConnected->userCreationDateFr(),
            'lastConnexion' => $userConnected->userLastConnexionDateFr()
        );
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
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'update'
     * Call Users Manager to update one user in databse
     * Redirect on index
     */
    public function update()
    {
        if (isset($_GET['userId']) && isset($_POST['login']) && isset($_POST['email'])) {        
            $affectedUser = $this->usersManager->setChangedUser($_GET['userId'], $_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['email'], $_POST['role']);
    
            if($affectedUser === false) {
                throw new Exception("Impossible de mettre à jour l\'utilisateur !");
            } else  {
                header('Location: admin.php?url=users');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
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
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'updatePass'
     * Call Users Manager to change password of one user
     * Redirect on 
     */
    public function updatePass()
    {
        if (isset($_GET['userId']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) { 
            $userPassword = $_POST['password'];

            if ($userPassword === $_POST['passwordConfirm']) {
                $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                $affectedUser = $this->usersManager->setNewPasswordUser($_GET['userId'], $hashPassword);
    
                if($affectedUser === false) {
                    header('Location: admin.php?url=users&action=account&alert=passUpdateError');
                    exit();
                } else  {
                    header('Location: admin.php?url=users&action=account&alert=passSuccess');
                    exit();
                }
            } else {
                header('Location: admin.php?url=users&action=account&alert=passError');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }
    }
}