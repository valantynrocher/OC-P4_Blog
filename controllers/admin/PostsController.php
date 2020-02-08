<?php 
require_once 'views/admin/View.php';

class PostsController {

    private $_postsManager;
    private $_categoryManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->singlePost();
        }
    }

    private function singlePost() {
        $this->_postsManager = new PostsManager();
        $posts = $this->_postsManager->getPosts();

        $this->_categoryManager = new CategoryManager();
        $categories = $this->_categoryManager->getCategories();

        $this->_view = new View('posts');

        if (isset($_GET['showPostId'])) {
            $this->_postsManager = new PostsManager();
            $postToRead = $this->_postsManager->getPost($_GET['showPostId']);
            $this->_view->generate(array('posts' => $posts, 'categories' => $categories, 'postToRead' => $postToRead));
        }
        else if (isset($_GET['editPostId'])) {
            $this->_postsManager = new PostsManager();
            $postToUpdate = $this->_postsManager->getPost($_GET['editPostId']);
            $this->_view->generate(array('posts' => $posts, 'categories' => $categories, 'postToUpdate' => $postToUpdate));
        }
        else {
            $this->_view->generate(array('posts' => $posts, 'categories' => $categories));
        }        
        
    }
}