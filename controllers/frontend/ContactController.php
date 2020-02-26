<?php
require_once 'views/frontend/View.php';

class ContactController
{

    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();

        $this->contact();
    }

    private function contact()
    {
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('contact');
        $this->view->generate(array(), $categories);
    }
}