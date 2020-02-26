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
        $this->postsManager = new PostsManager();
        $this->commentsManager = new CommentsManager();
        $this->categoryManager = new CategoryManager();

        if (isset($_GET['postId'])) {
            $this->singlePost($_GET['postId']);
        } else {
            throw new Exception('Des données n\'ont pas pu être récupérées');
        }
    }

    private function singlePost($postId)
    {
        $post = $this->postsManager->getOnePublicPost($postId);
        if (empty($post)) {
            throw new \Exception("Cet article n'est pas public");
        }

        $comments = $this->commentsManager->getCommentsByPost($postId);

        $categories = $this->categoryManager->getAllCategories();

        $this->view = new View('post');
        $this->view->generate(array('post' => $post, 'comments' => $comments, 'categories' => $categories), $categories);
    }
}