<?php
require_once 'views/frontend/View.php';

class ContactController
{

    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->contact();
    }

    private function contact()
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getCategories();

        $this->view = new View('contact');
        $this->view->generate(array(), $categories);
    }
}