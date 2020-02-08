<?php 
require_once 'views/admin/View.php';

class DashboardController {

    private $_postsManager;
    private $_commentsManager;
    private $_categoriesManager;
    private $_usersManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->dashboard();
        }
    }

    private function dashboard() {
        

        $this->_view = new View('dashboard');
        $this->_view->generate(array());
    }
}