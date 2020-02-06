<?php
require_once 'views/frontend/View.php';

class CategoryController {

    private $_postsManager;
    private $_categoryManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        }
        else {
            $this->postsCategory();
        }
    }

    private function postsCategory() {
        if (isset($_GET['cat_id'])) {
            $this->_postsManager = new PostsManager();
            $postsCategory = $this->_postsManager->getCategoryPosts($_GET['cat_id']);

            $this->_categoryManager = new CategoryManager();
            $category = $this->_categoryManager->getCategory($_GET['cat_id']);


            $this->_view = new View('category');
            $this->_view->generate(array('postsCategory' => $postsCategory, 'category' => $category));
        }
    }
}