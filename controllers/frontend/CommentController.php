<?php 
require_once 'views/frontend/View.php';

class CommentController
{
    private $commentsManager;
    private $view;
    public $actionError = 'Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'publish':
                if (isset($_GET['postId']) && isset($_POST['author']) && isset($_POST['comment'])) {
                    $this->publish($_GET['postId'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'report':
                if (isset($_GET['commentId']) && isset($_GET['postId'])) {
                    $this->report($_GET['commentId'], $_GET['postId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            default:
                throw new Exception('Action impossible !');
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