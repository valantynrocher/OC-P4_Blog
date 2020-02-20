<?php 
require_once 'views/frontend/View.php';

class CommentController
{
    private $commentsManager;
    private $view;

    public function __construct()
    {
        if ($_GET['action'] === 'publish') {
            if (isset($_GET['postId']) && isset($_POST['author']) && isset($_POST['comment'])) {
                $this->publish($_GET['postId'], $_POST['author'], $_POST['comment']);
            } else {
                throw new Exception('Des données n\'ont pas pu être récupérées');
            }
        } else if ($_GET['action'] === 'report') {
            if (isset($_GET['commentId']) && isset($_GET['postId'])) {
                $this->report($_GET['commentId'], $_GET['postId']);
            } else {
                throw new Exception('Des données n\'ont pas pu être récupérées');
            }
        }
        else {
            throw new Exception('Action impossible');
        }
    }

    private function publish($postId, $commentAuthor, $commentContent)
    {
        $author = htmlspecialchars($commentAuthor);
        $comment = htmlspecialchars($commentContent);

        $this->commentsManager = new CommentsManager();
        $affectedComment = $this->commentsManager->setNewComment($postId, $commentAuthor, $commentContent);

        if ($affectedComment === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: post&id='.$postId);
            exit();
        }
    }

    private function report($commentId, $postId)
    {
        $this->commentsManager = new CommentsManager();
        $affectedComment = $this->commentsManager->setReportComment($commentId);

        if ($affectedComment === false) {
            throw new Exception('Action impossible');
        } else {
            header('Location: post&postId='.$postId);
            exit();
        }
    }
}