<?php 
require_once 'views/admin/View.php';

class PostsController
{

    private $postsManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->singlePost();
        }
    }

    private function singlePost()
    {
        $this->postsManager = new PostsManager();
        $posts = $this->postsManager->getPosts();

        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getCategories();

        $this->view = new View('posts');

        if (isset($_GET['showPostId'])) {
            $this->postsManager = new PostsManager();
            $postToRead = $this->postsManager->getPost($_GET['showPostId']);
            $this->view->generate(array('posts' => $posts, 'categories' => $categories, 'postToRead' => $postToRead));
        } else if (isset($_GET['editPostId'])) {
            $this->postsManager = new PostsManager();
            $postToUpdate = $this->postsManager->getPost($_GET['editPostId']);
            $this->view->generate(array('posts' => $posts, 'categories' => $categories, 'postToUpdate' => $postToUpdate));
        } else {
            $this->view->generate(array('posts' => $posts, 'categories' => $categories));
        }        
    }
}