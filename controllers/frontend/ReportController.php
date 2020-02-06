<?php 
require_once 'views/frontend/View.php';

class ReportController {

    private $_commentsManager;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->newComment();
        }
    }

    private function newComment() {
        if (isset($_GET['id']) && isset($_GET['postId'])) {
            $this->_commentsManager = new CommentsManager();
            $affectedComment = $this->_commentsManager->reportOneComment($_GET['id']);

            if($affectedComment === false)
            {
                throw new Exception('Action impossible');
            }
            else 
            {
                header('Location: post&id=' . $_GET['postId']);
            }
        }
    }
}