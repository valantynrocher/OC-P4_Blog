<?php 
require_once 'views/frontend/View.php';

class CommentController
{
    private $commentsManager;
    private $view;

    public function __construct()
    {
        if ($_GET['action'] === 'add') {
            $this->publish($_GET['postId'], $_POST['author'], $_POST['comment']);
        } else if ($_GET['action'] === 'report') {
            $this->report($_GET['commentId'], $_GET['postId']);
        }
        else {
            throw new Exception('Action impossible');
        }
    }

    private function publish($postId, $commentAuthor, $commentContent)
    {
        if (isset($postId) && isset($commentAuthor) && isset($commentContent)) {
            $author = htmlspecialchars($commentAuthor);
            $comment = htmlspecialchars($commentContent);

            $this->commentsManager = new CommentsManager();
            $affectedComment = $this->commentsManager->setNewComment($postId, $commentAuthor, $commentContent);

            if ($affectedComment === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: post&id=' . $postId);
                exit();
            }
        }
    }

    private function report($commentId, $postId)
    {
        if (isset($id) && isset($postId)) {
            $this->commentsManager = new CommentsManager();
            $affectedComment = $this->commentsManager->setReportComment($commentId);

            if ($affectedComment === false) {
                throw new Exception('L\'action impossible');
            } else {
                header('Location: post&postId=' . $postId);
                exit();
            }
        }
    }
}