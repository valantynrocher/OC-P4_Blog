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
        $this->dashboard();
    }

    private function dashboard()
    {

        $this->view = new View('dashboard');
        $this->view->generate(array());
    }
}