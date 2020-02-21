<?php 
require_once 'views/admin/View.php';

class CommentsController
{

    private $postsManager;
    private $commentsManager;
    private $view;

    public function __construct()
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listComments();
                break;
            case 'moderate':
                if (isset($_GET['commentId'])) {
                    $this->moderateComment($_GET['commentId']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
                break;
            case 'delete':
                if (isset($_GET['commentId'])) {
                    $this->deleteComment($_GET['commentId']);
                } else {
                    throw new Exception('Des données n\'ont pas pu être récupérées');
                }
                break;
            default:
                throw new Exception('Action inconnue');
        }
    }

    private function listComments()
    {
        $this->commentsManager = new CommentsManager();
        $reportComments = $this->commentsManager->getReportedComments();
        $waitingComments = $this->commentsManager->getWaitingComments();
        $moderateComments = $this->commentsManager->getModeratedComments();

        $this->view = new View('comments');
        $this->view->generate(array('reportComments' => $reportComments, 'waitingComments' => $waitingComments, 'moderateComments' => $moderateComments));
    }

    private function moderateComment($commentId)
    {
        $this->commentsManager = new CommentsManager();
        $moderatePost = $this->commentsManager->setModerateComment($commentId);

        if($moderatePost === false) {
            throw new \Exception("Impossible de modérer le commentaire !");
        } else {
            header('Location: admin.php?url=comments&action=list');
            exit();
        }
    }

    private function deleteComment($commentId)
    {
        $this->commentsManager = new CommentsManager();
        $deletedComment = $this->commentsManager->setCommentDeleted($commentId);

        if($deletedComment === false) {
            throw new \Exception("Impossible de supprimer le commentaire !");
        } else {
            header('Location: admin.php?url=comments&action=list');
            exit();
        }
    }
}