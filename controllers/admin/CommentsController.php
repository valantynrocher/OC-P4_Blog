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
                $this->moderateComment($_GET['id']);
                break;
            case 'delete':
                $this->deleteComment($_GET['id']);
                break;
            default:
                throw new Exception('Action inconnue');
        }
    }

    private function listComments()
    {
        $this->commentsManager = new CommentsManager();
        $reportComments = $this->commentsManager->listReportComments();
        $moderateComments = $this->commentsManager->listModerateComments();

        $this->view = new View('comments');
        $this->view->generate(array('reportComments' => $reportComments, 'moderateComments' => $moderateComments));
    }

    private function moderateComment($id)
    {
        if (isset($id)) {
            $this->commentsManager = new CommentsManager();
            $moderatePost = $this->commentsManager->moderateOneComment($id);

            if($moderatePost === false) {
                throw new \Exception("Impossible de modérer le commentaire !");
            } else {
                header('Location: admin.php?url=comments&action=list');
                exit();
            }
        }
    }

    private function deleteComment($id)
    {
        if (isset($id)) {
            $this->commentsManager = new CommentsManager();
            $deletedComment = $this->commentsManager->deleteOneComment($id);

            if($deletedComment === false) {
                throw new \Exception("Impossible de supprimer le commentaire !");
            } else {
                header('Location: admin.php?url=comments&action=list');
                exit();
            }
        }
    }
}