<?php
namespace JeanForteroche\Controllers\Admin;

use JeanForteroche\Controllers\Controller;
use JeanForteroche\Views\View;
use JeanForteroche\Models\CommentsManager;
use \Exception;

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
        $comments = $this->commentsManager->getAllComments();
        $this->generateView(array(
            'comments' => $comments
        ));
    }

    /**
     * Action 'answer'
     * Generates view to answer to a comment
     */  
    public function answer()
    {
        if (isset($_GET['commentId'])) {
            $commentId = htmlspecialchars(strip_tags((int)$_GET['commentId']));

            if (filter_var($commentId, FILTER_VALIDATE_INT)) {
                $commentToAnswer = $this->commentsManager->getOneComment($commentId);
                $this->generateView(array(
                    'commentToAnswer' => $commentToAnswer
                ));
            } else {
                throw new Exception($this->datasError);
            }
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
            $commentId = htmlspecialchars(strip_tags((int)$_GET['commentId']));

            if (filter_var($commentId, FILTER_VALIDATE_INT)) {
                $moderatePost = $this->commentsManager->setModerateComment($commentId);

                if($moderatePost === false) {
                    throw new \Exception("Impossible de modérer le commentaire !");
                } else {
                    header('Location: admin.php?url=comments');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
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
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));
            $commentStartId = htmlspecialchars(strip_tags((int)$_GET['commentStartId']));
            $commentAuthor = htmlspecialchars(strip_tags($_POST['author']));
            $commentContent = htmlspecialchars(strip_tags($_POST['content']));

            if (filter_var($postId, FILTER_VALIDATE_INT) && filter_var($commentStartId, FILTER_VALIDATE_INT)) {
                $commentAnswer = $this->commentsManager->setCommentAnswer($postId, $commentAuthor, $commentContent, $commentStartId);

                if($commentAnswer === false) {
                    throw new \Exception("Impossible d'ajouter la réponse !");
                } else {
                    header('Location: admin.php?url=comments');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
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
            $commentId = htmlspecialchars(strip_tags((int)$_GET['commentId']));

            if (filter_var($commentId, FILTER_VALIDATE_INT)) {
                $deletedComment = $this->commentsManager->setCommentDeleted($commentId);

                if($deletedComment === false) {
                    throw new \Exception("Impossible de supprimer le commentaire !");
                } else {
                    header('Location: admin.php?url=comments');
                    exit();
                }
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }
    
}