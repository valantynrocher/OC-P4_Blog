<?php
require_once 'views/frontend/View.php';

class CategoryController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        $this->postsCategory();
    }

    private function postsCategory()
    {
        if (isset($_GET['id'])) {
            $this->postsManager = new PostsManager();
            $postsCategory = $this->postsManager->getCategoryPosts($_GET['id']);

            $this->categoryManager = new CategoryManager();
            $category = $this->categoryManager->getCategory($_GET['id']);
            $categories = $this->categoryManager->getCategories();


            $this->view = new View('category');
            $this->view->generate(array('postsCategory' => $postsCategory, 'category' => $category, 'categories' => $categories), $categories);
        }
    }
}