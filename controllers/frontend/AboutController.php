<?php
require_once 'views/frontend/View.php';

class AboutController
{

    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->about();
    }

    private function about()
    {
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('about');
        $this->view->generate(array(), $categories);
    }
}