<?php
require_once 'views/frontend/View.php';

class LegalsController
{

    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();

        $this->legals();
    }

    private function legals()
    {
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('legals');
        $this->view->generate(array(), $categories);
    }
}