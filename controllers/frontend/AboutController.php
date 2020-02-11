<?php
require_once 'views/frontend/View.php';

class AboutController
{

    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->about();
    }

    private function about()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getCategories();

        $this->view = new View('about');
        $this->view->generate(array(), $categories);
    }
}