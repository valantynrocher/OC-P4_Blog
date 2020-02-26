<?php
require_once 'views/frontend/View.php';

class CategoryController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
        $this->categoryManager = new CategoryManager();

        if (isset($_GET['categoryId'])) {
            $this->postsCategory($_GET['categoryId']);
        } else {
            throw new Exception('Des données n\'ont pas pu être récupérées');
        }
    }

    private function postsCategory($categoryId)
    {
        $postsByCategory = $this->postsManager->getPublicPostsByCategory($categoryId);
        
        $category = $this->categoryManager->getOneCategory($categoryId);
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('category');
        $this->view->generate(array('postsByCategory' => $postsByCategory, 'category' => $category, 'categories' => $categories), $categories);
    }
}