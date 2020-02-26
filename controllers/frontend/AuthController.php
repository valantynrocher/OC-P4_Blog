<?php 
require_once 'views/frontend/View.php';
require_once 'services/LoginService.php';

class AuthController
{
    private $usersManager;
    private $categoryManager;
    private $view;
    public $actionError = '<i class="fas fa-exclamation-circle"></i> Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->usersManager = new UsersManager();

        $action = $_GET['action'];
        
        switch ($action) {
            case 'auth':
                if (LoginService::isConnected()) {
                    $this->redirectConnectedUser($_SESSION['user']['role']);
                } else {
                    $this->authentification();
                }
                break;
            case 'login':
                if (isset($_POST['signIn'])) {
                    $this->login($_POST['login'], $_POST['password']);
                }
                break;
            case 'signup':
                if (isset($_POST['signUp'])) {
                    $this->signup($_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'account':
                if (LoginService::isConnected()) {
                    $this->accountUser();
                } else {
                    $this->authentification();
                }
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                throw new Exception('Action impossible !');
        }
    }

    private function authentification($errorLoginMsg = null, $errorSignupMsg = null, $successMsg = null)
    {      
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('auth');
        $this->view->generate(array(
            'errorLoginMsg' => $errorLoginMsg,
            'errorSignupMsg' => $errorSignupMsg,
            'successMsg' => $successMsg
        ), $categories);
    }

    private function checkIfUserExist($userLogin): bool
    {
        $userRegisterNumber = $this->usersManager->getUserRegisterNumber($userLogin);

        if ($userRegisterNumber === 0) {
            return false;
        } else if ($userRegisterNumber > 0) {
            return true;
        }
    }

    private function login($userLogin, $userPaswword)
    {
        $userExist = $this->checkIfUserExist($userLogin);
        var_dump($userExist);
        
        if ($userExist === false) {
            // don't know this user login
            $errorLoginMsg = 'Aucun utilisateur n\'est associé à cet identifiant.';
            $this->authentification($errorLoginMsg, null, null);
        } else {
            // user exists
            $authUser = $this->usersManager->getAuthUser($userLogin);
            if (password_verify($userPaswword, $authUser[0]->userPassword())) {
                $this->usersManager->setLastConnexionUser($authUser[0]->userId());
                $this->openSession($authUser[0]);
            } else {
                $errorLoginMsg = 'L\'identifiant et/ou le mot de passe saisi est incorrect.';
                $this->authentification($errorLoginMsg, null, null);
            }
        }
    }

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

    private function redirectConnectedUser($userRole)
    {
        if ($userRole === 'admin') {
            header('Location: admin.php?url=dashboard');
            exit();
        } else if ($userRole === 'reader') {
            header('Location: /auth&action=account');
            exit();
        }
    }

    protected function signup($userFirstName, $userLastName, $userLogin, $userPassword, $passwordConfirm, $userEmail)
    {
        $userExist = $this->checkIfUserExist($userLogin);
        
        if ($userExist === false) {
            if ($userPassword === $passwordConfirm) {
                $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    
                $affectedUser = $this->usersManager->setNewUser($userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, 'reader');
    
                if ($affectedUser === false) {
                    $errorSignupMsg = 'Une erreur est survenue, impossible de créer le compte. Veuillez recommencer.';
                    $this->authentification(null, $errorSignupMsg, null);
                } else {
                    $successMsg = 'Votre compte a été créé avec succès ! Connectez-vous à présent pour profiter au mieux de mon site <i class="fas fa-smile-wink"></i>';
                    $this->authentification(null, null, $successMsg);
                }
            } else {
                $errorSignupMsg = 'Les mots de passes saisis ne correspondent pas.';
                $this->authentification(null, $errorSignupMsg, null);
            }
        } else {
            $errorSignupMsg = 'Un utilisateur est déjà associé à cet identifiant.';
            $this->authentification(null, $errorSignupMsg, null);
        }
    }

    protected function accountUser()
    {
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('accountUser');
        $this->view->generate(array(), $categories);
    }

    private function logout()
    {
        $_SESSION = array();
        session_destroy();

        header('Location: /home');
        exit();
    }

}