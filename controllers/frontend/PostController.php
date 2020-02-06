<?php 
require_once 'views/frontend/View.php';

class PostController {

    private $_postsManager;
    private $_commentsManager;
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
        if (isset($_GET['id'])) {
            $this->_postsManager = new PostsManager();
            $post = $this->_postsManager->getPost($_GET['id']);

            $this->_commentsManager = new CommentsManager();
            $comments = $this->_commentsManager->getComments($_GET['id']);

            $this->_view = new View('post');
            $this->_view->generate(array('post' => $post, 'comments' => $comments));
        }
    }
}