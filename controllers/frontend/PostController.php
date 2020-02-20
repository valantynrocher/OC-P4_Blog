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
        if (isset($_GET['postId'])) {
            $this->singlePost($_GET['postId']);
        } else {
            throw new Exception('Des données n\'ont pas pu être récupérées');
        }
    }

    private function singlePost($postId)
    {
        $this->postsManager = new PostsManager();
        $post = $this->postsManager->getOnePost($postId);

        $this->commentsManager = new CommentsManager();
        $comments = $this->commentsManager->getCommentsByPost($postId);

        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('post');
        $this->view->generate(array('post' => $post, 'comments' => $comments, 'categories' => $categories), $categories);
    }
}