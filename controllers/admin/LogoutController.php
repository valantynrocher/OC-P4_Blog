<?php 
require_once 'views/admin/View.php';

class LogoutController
{

    public function __construct()
    {
        $this->logout();
    }

    private function logout()
    {
        $_SESSION['connected'] = 0;
        header('Location: admin.php?url=login');
        exit();
    }
}