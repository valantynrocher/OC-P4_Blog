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
            case 'auth':
                // si utilisateur non connecté
                $this->welcomeAuth();
                // si utilisateur connecté
                // header('Location: auth&action=account');
                // exit();
                break;
            case 'account':
                // si utilisateur non connecté
                // header('Location: auth&action=auth');
                // exit();
                // si utilisateur connecté
                // $this->accountUser()
            case 'signup':
                if (isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
                    $this->userSignup($_POST['firstName'], $_POST['lastName'], $_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            default:
                throw new Exception('Action impossible !');
        }
    }

    private function welcomeAuth()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('welcomeAuth');
        $this->view->generate(array(), $categories);
    }

    protected function userSignup($userFirstName, $userLastName, $userLogin, $userPassword, $passwordConfirm, $userEmail)
    {
        if ($userPassword === $passwordConfirm) {
            $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);

            $this->usersManager = new UsersManager();
            $affectedUser = $this->usersManager->setNewUser($userFirstName, $userLastName, $userLogin, $hashPassword, $userEmail, 'reader');

            if ($affectedUser === false) {
                $this->view = new View('welcomeAuth');
                $errorSignupMsg = 'Une erreur est survenue, impossible de créer le compte. Veuillez recommencer.';
                $this->view->generate(array('errorSignupMsg' => $errorSignupMsg));
            } else {
                $this->view = new View('welcomeAuth');
                $successMsg = 'Votre compte a été créé avec succès ! Connectez-vous à présent pour profiter au mieux de mon site <i class="fas fa-smile-wink"></i>';
                $this->view->generate(array('successMsg' => $successMsg));
            }
        } else {
            $this->view = new View('welcomeAuth');
            $errorSignupMsg = 'Les mots de passes saisis ne correspondent pas.';
            $this->view->generate(array('errorSignupMsg' => $errorSignupMsg));
        }
    }

    protected function userAccount()
    {

    }

}