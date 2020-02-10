<?php 
require_once 'views/admin/View.php';

class CommentsController
{

    private $postsManager;
    private $commentsManager;
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
        $this->view = new View('comments');
        $this->view->generate(array());
    }
}