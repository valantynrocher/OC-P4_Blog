<?php
namespace JeanForteroche\Controllers\Frontend;

use JeanForteroche\Views\View;
use JeanForteroche\Controllers\Controller;
use JeanForteroche\Services\Login;
use JeanForteroche\Models\PostsManager;
use JeanForteroche\Models\CommentsManager;
use \Exception;

class PostController extends Controller
{
    /**
     * Manager for posts
     */
    private $postsManager;

    /**
     * Manager for comments
     */
    private $commentsManager;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
        $this->commentsManager = new CommentsManager();
    }

    /**
     * Action 'index' (default)
     * Generates view to show one post with related comments
     */
    public function index()
    {
        if (isset($_GET['postId'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));
            // Non loggin user or readers can see only public posts
            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $post = $this->postsManager->getOnePublicPost($postId);
                if (Login::isAdmin()) {
                    // admin users can see any posts
                    $post = $this->postsManager->getOnePost($postId);
                }
    
                if (empty($post)) {
                    throw new Exception("Cet article n'est pas public");
                }
        
                $comments = $this->commentsManager->getCommentsByPost($postId);
        
                $this->generateView(array(
                    'post' => $post,
                    'comments' => $comments,
                    'categories' => $this->getCategories()
                ));
            } else {
                throw new Exception($this->datasError);
            }  
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'newComment'
     * Call Comments Manager to set new comment related to the current post in databse
     * Redirect on index
     */  
    public function newComment()
    {
        if (isset($_GET['postId']) && isset($_POST['author']) && isset($_POST['comment'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $commentAuthor = htmlspecialchars(strip_tags($_POST['author']));
                $commentContent = htmlspecialchars(strip_tags($_POST['comment']));
                
                $affectedComment = $this->commentsManager->setNewComment($postId, $commentAuthor, $commentContent);
        
                if ($affectedComment === false) {
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: post&postId='.$postId);
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
     * Action 'report'
     * Call Comments Manager to set a comment status to 'report' in databse
     * Redirect on index
     */
    public function report()
    {
        if (isset($_GET['commentId']) && isset($_GET['postId'])) {
            $commentId = htmlspecialchars(strip_tags((int)$_GET['commentId']));
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT) && filter_var($commentId, FILTER_VALIDATE_INT)) {
                $affectedComment = $this->commentsManager->setReportComment($commentId);

                if ($affectedComment === false) {
                    throw new Exception('Action impossible');
                } else {
                    header('Location: post&postId='.$_GET['postId']);
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