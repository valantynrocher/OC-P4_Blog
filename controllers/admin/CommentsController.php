<?php 
require_once 'views/admin/View.php';

class CommentsController {

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
        $this->_view = new View('comments');
        $this->_view->generate(array());
    }
}