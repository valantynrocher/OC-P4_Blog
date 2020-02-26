<?php 
require_once 'views/admin/View.php';

class CommentsController
{

    private $postsManager;
    private $commentsManager;
    private $view;
    public $actionError = 'Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $this->commentsManager = new CommentsManager();

        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listComments();
                break;
            case 'moderate':
                if (isset($_GET['commentId'])) {
                    $this->moderateComment($_GET['commentId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'delete':
                if (isset($_GET['commentId'])) {
                    $this->deleteComment($_GET['commentId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            case 'answer':
                if (isset($_GET['commentId'])) {
                    $this->answerComment($_GET['commentId']);
                } else {
                    throw new Exception($this->actionError);
                }
            case 'insert':
                if (isset($_GET['postId']) && isset($_POST['commentStartId']) && isset($_POST['author']) && isset($_POST['content'])) {
                    $this->insertCommentAnswer($_GET['postId'], $_POST['author'], $_POST['content'], $_POST['commentStartId']);
                } else {
                    throw new Exception($this->actionError);
                }
                break;
            default:
                throw new Exception('Action impossible !');
        }
    }

    private function listComments()
    {
        $reportComments = $this->commentsManager->getReportedComments();
        $waitingComments = $this->commentsManager->getWaitingComments();
        $moderateComments = $this->commentsManager->getModeratedComments();

        $this->view = new View('comments/listComments');
        $this->view->generate(array(
            'reportComments' => $reportComments,
            'waitingComments' => $waitingComments,
            'moderateComments' => $moderateComments
        ));
    }

    private function moderateComment($commentId)
    {
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
        $deletedComment = $this->commentsManager->setCommentDeleted($commentId);

        if($deletedComment === false) {
            throw new \Exception("Impossible de supprimer le commentaire !");
        } else {
            header('Location: admin.php?url=comments&action=list');
            exit();
        }
    }

    private function answerComment($commentId)
    {
        $commentToAnswer = $this->commentsManager->getOneComment($commentId);

        $this->view = new View('comments/answerComment');
        $this->view->generate(array(
            'commentToAnswer' => $commentToAnswer
        ));
    }

    private function insertCommentAnswer($postId, $commentAuthor, $commentContent, $commentStartId)
    {
        $commentAnswer = $this->commentsManager->setCommentAnswer($postId, $commentAuthor, $commentContent, $commentStartId);

        if($commentAnswer === false) {
            throw new \Exception("Impossible d'ajouter la réponse !");
        } else {
            header('Location: admin.php?url=comments&action=list');
            exit();
        }
    }
}