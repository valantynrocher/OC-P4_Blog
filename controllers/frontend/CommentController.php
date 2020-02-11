<?php 
require_once 'views/frontend/View.php';

class CommentController
{
    private $commentsManager;
    private $view;

    public function __construct()
    {
        if ($_GET['action'] === 'add') {
            $this->add($_GET['id']);
        } else if ($_GET['action'] === 'report') {
            $this->report($_GET['id'], $_GET['postId']);
        }
        else {
            throw new Exception('Action inconnue');
        }
    }

    private function add($id)
    {
        if (isset($id)) {
            $author = htmlspecialchars($_POST['author']);
            $comment = htmlspecialchars($_POST['comment']);

            $this->commentsManager = new CommentsManager();
            $affectedComment = $this->commentsManager->addComment($id, $author, $comment);

            if ($affectedComment === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: post&id=' . $id);
                exit();
            }
        }
    }

    private function report($id, $postId)
    {
        if (isset($id) && isset($postId)) {
            $this->commentsManager = new CommentsManager();
            $affectedComment = $this->commentsManager->reportOneComment($id);

            if ($affectedComment === false) {
                throw new Exception('L\'action impossible');
            } else {
                header('Location: post&id=' . $postId);
                exit();
            }
        }
    }
}