<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class CommentsController extends Controller
{

    /**
     * Manager for comments
     */
    private $commentsManager;

    public function __construct()
    {
        $this->commentsManager = new CommentsManager();
    }

    /**
     * Action 'index' (default)
     * Generates view to list comments
     */    
    public function index()
    {
        $reportComments = $this->commentsManager->getReportedComments();
        $waitingComments = $this->commentsManager->getWaitingComments();
        $moderateComments = $this->commentsManager->getModeratedComments();

        $this->generateView(array(
            'reportComments' => $reportComments,
            'waitingComments' => $waitingComments,
            'moderateComments' => $moderateComments
        ));
    }

    /**
     * Action 'answer'
     * Generates view to answer to a comment
     */  
    public function answer()
    {
        if (isset($_GET['commentId'])) {
            $commentToAnswer = $this->commentsManager->getOneComment($_GET['commentId']);

            $this->generateView(array(
                'commentToAnswer' => $commentToAnswer
            ));
        } else {
            throw new Exception($this->datasError);
        }

    }

    /**
     * Action 'moderate' (default)
     * Call Comments Manager to set comment status to 'moderate' in databse
     * Redirect on index
     */  
    public function moderate()
    {
        if (isset($_GET['commentId'])) {
            $moderatePost = $this->commentsManager->setModerateComment($_GET['commentId']);

            if($moderatePost === false) {
                throw new \Exception("Impossible de modérer le commentaire !");
            } else {
                header('Location: admin.php?url=comments');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'insertAnswer'
     * Call Comments Manager to set new comment as answer to an other comment in databse
     * Redirect on index
     */  
    public function insertAnswer()
    {
        if (isset($_GET['postId']) && isset($_POST['commentStartId']) && isset($_POST['author']) && isset($_POST['content'])) {
            $commentAnswer = $this->commentsManager->setCommentAnswer($_GET['postId'], $_POST['author'], $_POST['content'], $_POST['commentStartId']);

            if($commentAnswer === false) {
                throw new \Exception("Impossible d'ajouter la réponse !");
            } else {
                header('Location: admin.php?url=comments');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }

    }

    /**
     * Action 'delete'
     * Call Comments Manager to delete comment in databse
     * Redirect on index
     */  
    public function delete()
    {
        if (isset($_GET['commentId'])) {
            $deletedComment = $this->commentsManager->setCommentDeleted($_GET['commentId']);

            if($deletedComment === false) {
                throw new \Exception("Impossible de supprimer le commentaire !");
            } else {
                header('Location: admin.php?url=comments');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }

    }

}