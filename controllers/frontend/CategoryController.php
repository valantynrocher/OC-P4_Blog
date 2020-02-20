<?php
require_once 'views/frontend/View.php';

class CategoryController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        if (isset($_GET['categoryId'])) {
            $this->postsCategory($_GET['categoryId']);
        } else {
            throw new Exception('Des données n\'ont pas pu être récupérées');
        }
    }

    private function postsCategory($categoryId)
    {
        $this->postsManager = new PostsManager();
        $postsByCategory = $this->postsManager->getPublicPostsByCategory($categoryId);

        $this->categoryManager = new CategoryManager();
        $category = $this->categoryManager->getOneCategory($categoryId);
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('category');
        $this->view->generate(array('postsByCategory' => $postsByCategory, 'category' => $category, 'categories' => $categories), $categories);
    }
}