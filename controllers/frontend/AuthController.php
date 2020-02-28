<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';
require_once 'services/Login.php';

class AuthController extends Controller
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
     * Check if user is connected to redirect to account()
     * If false, generates the view for authentification page
     * If true redirect user accordint to his role
     */
    public function index()
    {   
        if (Login::isConnected()) {
            $this->redirectConnectedUser($_SESSION['user']['role']);
        } else {
            // Init error params
            $alert = null;
            $errorLoginMsg = null;
            $errorSignupMsg = null;
            $successMsg = null;

            // Catch feedback during login or signup and set alert message
            if (isset($_GET['alert'])) {
                $alert = $_GET['alert'];
                switch($alert) {
                    case 'NotUser':
                        $errorLoginMsg = 'L\'identifiant saisi ne correspond à aucun utilisateur';
                        break;
                    case 'Login':
                        $errorLoginMsg = 'L\'identifiant ou le mot de passe saisi est incorrect.';
                        break;
                    case 'signup':
                        $errorSignupMsg = 'Une erreur est survenue, impossible de créer le compte. Veuillez recommencer.';
                        break;
                    case 'success':
                        $successMsg = 'Votre compte a été créé avec succès ! Connectez-vous à présent pour profiter au mieux de mon site <i class="fas fa-smile-wink"></i>';
                        break;
                    case 'passwords':
                        $errorSignupMsg = 'Les mots de passes saisis ne correspondent pas.';
                        break;
                    case 'userSignup':
                        $errorSignupMsg = 'Un utilisateur est déjà associé à cet identifiant.';
                        break;
                }
            }

            $this->generateView(array(
                'errorLoginMsg' => $errorLoginMsg,
                'errorSignupMsg' => $errorSignupMsg,
                'successMsg' => $successMsg
            ));
        }
    }

    /**
     * Action 'login'
     * Check login informations
     */
    public function login()
    {
        if (isset($_POST['signIn'])) {
            $userExist = $this->checkIfUserExist($_POST['login']);
            var_dump($userExist);
            
            if ($userExist === false) {
                header('Location: auth&alert=NotUser');
                exit();
            } else {
                $authUser = $this->usersManager->getAuthUser($_POST['login']);
                if (password_verify($_POST['password'], $authUser[0]->userPassword())) {
                    $this->usersManager->setLastConnexionUser($authUser[0]->userId());
                    $this->openSession($authUser[0]);
                } else {
                    header('Location: auth&alert=Login');
                    exit();
                }
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Opening session when login success
     * Take user informations and declare $_SESSION variables
     */
    private function openSession($userConnected)
    {  
        $_SESSION['connected'] = 1;
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
        
        $this->redirectConnectedUser($_SESSION['user']['role']);
    }

    /**
     * Redirect user according to the role
     */
    public function redirectConnectedUser($userRole)
    {
        if ($userRole === 'admin') {
            header('Location: admin.php?url=dashboard');
            exit();
        } else if ($userRole === 'reader') {
            header('Location: /auth&action=account');
            exit();
        }
    }

    /**
     * Action 'signup'
     * Take user informations and set a new user in database
     * Redirect on authentification page
     */
    public function signup()
    {
        if (isset($_POST['signUp'])) {
            $userExist = $this->checkIfUserExist($_POST['login']);
            $userPassword = $_POST['password'];
        
            if ($userExist === false) {
                if ($userPassword === $_POST['passwordConfirm']) {
                    $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        
                    $affectedUser = $this->usersManager->setNewUser($_POST['firstName'], $_POST['lastName'], $_POST['login'], $hashPassword, $_POST['email'], 'reader');
        
                    if ($affectedUser === false) {
                        header('Location: auth&alert=signup');
                        exit();
                    } else {
                        header('Location: auth&alert=success');
                        exit();
                    }
                } else {
                    header('Location: auth&alert=passwords');
                    exit();
                }
            } else {
                header('Location: auth&alert=userSignup');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }

    }

    /**
     * Action 'account'
     * If user already connected, generates view for user account
     * If not, redirect to index
     */
    public function account()
    {
        if (Login::isConnected()) {
            $this->generateView(array());
        } else {
            $this->index();
        }

    }

    /**
     * Action 'logout'
     * Delete $_SESSION variables and destroy session
     * Redirect to index
     */
    public function logout()
    {
        $_SESSION = array();
        session_destroy();

        header('Location: /home');
        exit();
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