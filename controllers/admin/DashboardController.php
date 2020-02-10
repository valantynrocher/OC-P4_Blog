<?php 
require_once 'views/admin/View.php';

class DashboardController
{

    private $postsManager;
    private $commentsManager;
    private $categoriesManager;
    private $usersManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->dashboard();
        }
    }

    private function dashboard()
    {

        $this->view = new View('dashboard');
        $this->view->generate(array());
    }
}