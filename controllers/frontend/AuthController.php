<?php 
require_once 'views/frontend/View.php';

class AuthController
{
    private $usersManager;
    private $categoryManager;
    private $view;
    public $actionError = '<i class="fas fa-exclamation-circle"></i> Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $action = $_GET['action'];
        
        switch ($action) {
            case 'reader':
                if (!isset($_SESSION['connected']) || $_SESSION['connected'] === 0) {
                    $this->goToPublicAuth();
                } else {
                    $this->redirectConnectedUser('reader');
                }
                break;
            case 'admin':
                if (!isset($_SESSION['connected']) || $_SESSION['connected'] === 0) {
                    $this->goToAdminAuth();
                } else {
                    $this->redirectConnectedUser('admin');
                }
                break;
            case 'account':
                if (!isset($_SESSION['connected']) || $_SESSION['connected'] === 0) {
                    header('Location : auth&action=reader');
                    exit();
                } else if ($_SESSION['connected'] === 1) {
                    $this->accountUser();
                }
                break;
            case 'login':
                if (isset($_GET['userType']) && isset($_POST['login']) && isset($_POST['password'])) {
                    $this->login($_GET['userType'], $_POST['login'], $_POST['password']);
                }
                break;
            case 'signup':
                if (isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
                    $this->readerSignup($_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'logout':
                $this->resetSession();
                header('Location : /home');
                exit();
                break;
            default:
                throw new Exception('Action impossible !');
        }
    }

    private function goToPublicAuth()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('readerAuth');
        $this->view->generate(array(), $categories);
    }

    private function goToAdminAuth()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('adminAuth');
        $this->view->generate(array(), $categories);
    }

    private function checkIfUserExist($userLogin)
    {
        $this->usersManager = new UsersManager();
        $userRegisterNumber = $this->usersManager->getUserRegisterNumber($userLogin);

        if ($userRegisterNumber === 0) {
            return false;
        } else if ($userRegisterNumber > 0) {
            return true;
        }
    }

    private function login($userType, $userLogin, $userPaswword)
    {
        $userExist = $this->checkIfUserExist($userLogin);
        
        if ($userExist === false) {
            // don't know this user login
            $this->view = new View($userType.'Auth');
            $errorLoginMsg = 'Aucun utilisateur n\'est associé à cet identifiant.';
            $this->view->generate(array('errorLoginMsg' => $errorLoginMsg));
        } else {
            // user exists
            $authUser = $this->usersManager->getAuthUser($userLogin);
            
            if ($authUser[0]->userRole() === $userType) {
                // user can access
                if (password_verify($userPaswword, $authUser[0]->userPassword())) {
                    $this->openSession($authUser[0]);
                    print_r($_SESSION);
                } else {
                    $this->view = new View($userType.'Auth');
                    $errorLoginMsg = 'Le mot de passe saisi est incorrect.';
                    $this->view->generate(array('errorLoginMsg' => $errorLoginMsg));
                }
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
            'hashPassword' => $userConnected->userPassword(),
            'email' => $userConnected->userEmail(),
            'role' => $userConnected->userRole(),
            'creationDate' => $userConnected->userCreationDateFr()
        );
        
        $this->redirectConnectedUser($userConnected->userRole());
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

    protected function readerSignup($userFirstName, $userLastName, $userLogin, $userPassword, $passwordConfirm, $userEmail)
    {
        $userExist = $this->checkIfUserExist($userLogin);
        
        if ($userExist === false) {
            if ($userPassword === $passwordConfirm) {
                $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    
                $this->usersManager = new UsersManager();
                $affectedUser = $this->usersManager->setNewUser($userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, 'reader');
    
                if ($affectedUser === false) {
                    $this->view = new View('readerAuth');
                    $errorSignupMsg = 'Une erreur est survenue, impossible de créer le compte. Veuillez recommencer.';
                    $this->view->generate(array('errorSignupMsg' => $errorSignupMsg));
                } else {
                    $this->view = new View('readerAuth');
                    $successMsg = 'Votre compte a été créé avec succès ! Connectez-vous à présent pour profiter au mieux de mon site <i class="fas fa-smile-wink"></i>';
                    $this->view->generate(array('successMsg' => $successMsg));
                }
            } else {
                $this->view = new View('readerAuth');
                $errorSignupMsg = 'Les mots de passes saisis ne correspondent pas.';
                $this->view->generate(array('errorSignupMsg' => $errorSignupMsg));
            }
        } else {
            $this->view = new View('readerAuth');
            $errorSignupMsg = 'Un utilisateur est déjà associé à cet identifiant.';
            $this->view->generate(array('errorSignupMsg' => $errorSignupMsg));
        }
        
    }

    protected function accountUser()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('accountUser');
        $this->view->generate(array(), $categories);
    }

    private function resetSession()
    {
        $_SESSION = array();
        session_destroy();
    }

}