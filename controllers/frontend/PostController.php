<?php 
require_once 'views/frontend/View.php';

class PostController
{

    private $postsManager;
    private $commentsManager;
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
        if (isset($_GET['id'])) {
            $this->postsManager = new PostsManager();
            $post = $this->postsManager->getPost($_GET['id']);

            $this->commentsManager = new CommentsManager();
            $comments = $this->commentsManager->getComments($_GET['id']);

            $this->categoryManager = new CategoryManager();
            $categories = $this->categoryManager->getCategories();

            $this->view = new View('post');
            $this->view->generate(array('post' => $post, 'comments' => $comments, 'categories' => $categories));
        }
    }
}