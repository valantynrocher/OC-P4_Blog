<?php 
require_once 'views/frontend/View.php';

class CommentController {

    private $_commentsManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->newComment();
        }
    }

    private function newComment() {
        if (isset($_GET['id'])) {
            $this->_commentsManager = new CommentsManager();
            $affectedComment = $this->_commentsManager->addComment($_GET['id'], $_POST['author'], $_POST['comment']);

            if($affectedLines === false)
            {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else 
            {
                header('Location: post&id=' . $_GET['id']);
            }
        }
    }
}