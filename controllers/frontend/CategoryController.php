<?php
require_once 'views/frontend/View.php';

class CategoryController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        } else {
            $this->postsCategory();
        }
    }

    private function postsCategory()
    {
        if (isset($_GET['cat_id'])) {
            $this->postsManager = new PostsManager();
            $postsCategory = $this->postsManager->getCategoryPosts($_GET['cat_id']);

            $this->categoryManager = new CategoryManager();
            $category = $this->categoryManager->getCategory($_GET['cat_id']);
            $categories = $this->categoryManager->getCategories();


            $this->view = new View('category');
            $this->view->generate(array('postsCategory' => $postsCategory, 'category' => $category, 'categories' => $categories));
        }
    }
}