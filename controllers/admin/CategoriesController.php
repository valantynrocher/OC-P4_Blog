<?php 
require_once 'views/admin/View.php';

class CategoriesController
{

    private $postsManager;
    private $commentsManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->singlePost();
        }
    }

    private function singlePost()
    {
        $this->view = new View('categories');
        $this->view->generate(array());
    }
}