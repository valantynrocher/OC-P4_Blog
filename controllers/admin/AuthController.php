<?php 
require_once 'views/admin/View.php';

class AuthController
{
    private $usersManager;
    private $view;

    public function __construct()
    {
        
        switch ($action) {
            case 'logout':
                $this->logout();
                break;
        }
    }

    private function logout()
    {
        $_SESSION['connected'] = 0;
        $_SESSION['user'] = array();

        header('Location: admin.php?url=auth&action=login');
        exit();
    }
}