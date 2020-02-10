<?php 
require_once 'views/admin/View.php';

class LogoutController
{

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->logout();
        }
    }

    private function logout()
    {
        $_SESSION['connected'] = 0;
        header('Location: admin.php?url=login');
        exit();
    }
}