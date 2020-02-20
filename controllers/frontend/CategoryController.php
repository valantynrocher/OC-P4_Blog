<?php
require_once 'views/frontend/View.php';

class CategoryController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->postsCategory($_GET['categoryId']);
    }

    private function postsCategory($categoryId)
    {
        if (isset($categoryId)) {
            $this->postsManager = new PostsManager();
            $postsByCategory = $this->postsManager->getPublicPostsByCategory($categoryId);

            $this->categoryManager = new CategoryManager();
            $category = $this->categoryManager->getOneCategory($categoryId);
            $categories = $this->categoryManager->getAllCategories();

            $this->view = new View('category');
            $this->view->generate(array('postsByCategory' => $postsByCategory, 'category' => $category, 'categories' => $categories), $categories);
        }
    }
}