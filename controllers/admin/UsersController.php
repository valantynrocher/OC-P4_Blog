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
        // Init alert params
        $alert = null;
        $errorInsertMsg = null;

        // Catch feedback and set alert message
        if (isset($_GET['alert'])) {
            $alert = htmlspecialchars(strip_tags($_GET['alert']));
            switch($alert) {
                case 'insert':
                    $errorInsertMsg = 'Une erreur est survenue, impossible de créer le compte. Veuillez recommencer.';
                    break;
                case 'passwords':
                    $errorInsertMsg = 'Les mots de passes saisis ne correspondent pas.';
                    break;
                case 'userInsert':
                    $errorInsertMsg = 'Un utilisateur est déjà associé à cet identifiant.';
                    break;
            }
        }
        $this->generateView(array(
            'errorInsertMsg' => $errorInsertMsg
        ));
    }

    /**
     * Action 'edit'
     * Generates view to edit one user
     */
    public function edit()
    {
        if (isset($_GET['userId'])) {
            $userId = htmlspecialchars(strip_tags((int)$_GET['userId']));

            if (filter_var($userId, FILTER_VALIDATE_INT)) {
                $userToUpdate = $this->usersManager->getOneUser($userId);
                $this->generateView(array('userToUpdate' => $userToUpdate));
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'account'
     * Generates the view for user's connected account edition
     */
    public function account()
    {
        // Init alert params
        $alert = null;
        $errorInfosMsg = null;
        $successInfosMsg = null;
        $errorPassMsg = null;
        $successPassMsg = null;

        // Catch feedback during login or signup and set alert message
        if (isset($_GET['alert'])) {
            $alert = htmlspecialchars(strip_tags($_GET['alert']));
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

    /**
     * Action 'account'
     * Generates the view for user's connected account edition
     */
    public function updateAccount()
    {
        if (isset($_GET['userId']) && isset($_POST['login']) && isset($_POST['email'])) { 
            $userId = htmlspecialchars(strip_tags((int)$_GET['userId']));
            $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
            $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
            $login = htmlspecialchars(strip_tags($_POST['login']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $role = htmlspecialchars(strip_tags($_POST['role']));

            if (filter_var($userId, FILTER_VALIDATE_INT)) {
                $affectedUser = $this->usersManager->setChangedUser($userId, $firstName, $lastName, $login, $email, $role);
                $updatedAccount = $this->usersManager->getOneUser($userId);
                $this->updateSession($updatedAccount[0]);

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
            throw new Exception($this->datasError);
        }
    }


    /**
     * Private function to update datas for Session
     * when user update his informations
     */
    private function updateSession($user) {
        $_SESSION['user'] = array(
            'id' => $user->userId(),
            'firstName' => $user->userFirstName(),
            'lastName' => $user->userLastName(),
            'login' => $user->userLogin(),
            'email' => $user->userEmail(),
            'role' => $user->userRole(),
            'creationDate' => $user->userCreationDateFr(),
            'lastConnexion' => $user->userLastConnexionDateFr()
        );
    }

    /**
     * Action 'insert'
     * Call Users Manager to insert new user in databse
     * Redirect on index
     */
    public function insert()
    {
        if (isset($_POST['submit'])) {
            $userExist = $this->checkIfUserExist(htmlspecialchars(strip_tags($_POST['login'])));
            $userPassword = htmlspecialchars(strip_tags($_POST['password']));
        
            if ($userExist === false) {
                if ($userPassword === htmlspecialchars(strip_tags($_POST['passwordConfirm']))) {
                    $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
                    $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
                    $login = htmlspecialchars(strip_tags($_POST['login']));
                    $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                    $email = htmlspecialchars(strip_tags($_POST['email']));
                    $role = htmlspecialchars(strip_tags($_POST['role']));

                    $affectedUser = $this->usersManager->setNewUser($firstName, $lastName, $login, $hashPassword, $email, $role);
            
                    if ($affectedUser === false) {
                        header('Location: admin.php?url=users&action=create&alert=insert');
                        exit();
                    } else {
                        header('Location: admin.php?url=users');
                        exit();
                    }
                } else {
                    header('Location: admin.php?url=users&action=create&alert=passwords');
                    exit();
                }
            } else {
                header('Location: admin.php?url=users&action=create&alert=userInsert');
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
        if (isset($_POST['submit'])) {
            $userId = htmlspecialchars(strip_tags((int)$_GET['userId']));
            $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
            $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
            $login = htmlspecialchars(strip_tags($_POST['login']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $role = htmlspecialchars(strip_tags($_POST['role']));

            if (filter_var($userId, FILTER_VALIDATE_INT)) {
                $affectedUser = $this->usersManager->setChangedUser($userId, $firstName, $lastName, $login, $email, $role);
    
                if($affectedUser === false) {
                    throw new Exception("Impossible de mettre à jour l\'utilisateur !");
                } else  {
                    header('Location: admin.php?url=users');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
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
            $userId = htmlspecialchars(strip_tags((int)$_GET['userId']));

            if (filter_var($userId, FILTER_VALIDATE_INT)) {
                $deletedUser = $this->usersManager->setUserDeleted($userId);

                if($deletedUser === false) {
                    throw new \Exception("Impossible de supprimer l\'utilisateur !");
                } else {
                    header('Location: admin.php?url=users');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'updatePass'
     * Call Users Manager to change password of connected user
     * Redirect on 
     */
    public function updatePass()
    {
        if (isset($_GET['userId']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
            $userId = htmlspecialchars(strip_tags((int)$_GET['userId']));
            $userPassword = htmlspecialchars(strip_tags($_POST['password']));

            if (filter_var($userId, FILTER_VALIDATE_INT)) {
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
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Check if user already exist
     * Useful when a user try to login or
     * when a user want to create an account
     */
    private function checkIfUserExist($userLogin): bool
    {
        $userRegisterNumber = $this->usersManager->getUserRegisterNumber($userLogin);

        if ($userRegisterNumber === 0) {
            return false;
        } else if ($userRegisterNumber > 0) {
            return true;
        }
    }
}