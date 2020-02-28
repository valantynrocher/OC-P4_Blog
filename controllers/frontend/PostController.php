<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

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
            $postId = $_GET['postId'];
            $post = $this->postsManager->getOnePublicPost($postId);

            if (empty($post)) {
                throw new \Exception("Cet article n'est pas public");
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
    }

    /**
     * Action 'newComment'
     * Call Comments Manager to set new comment related to the current post in databse
     * Redirect on index
     */  
    private function newComment()
    {
        if (isset($_GET['postId']) && isset($_POST['author']) && isset($_POST['comment'])) {
            $postId = $_GET['postId'];
            $commentAuthor = $_POST['author'];
            $commentContent = $_POST['comment'];
            
            $affectedComment = $this->commentsManager->setNewComment($postId, $commentAuthor, $commentContent);
    
            if ($affectedComment === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: post&id='.$postId);
                exit();
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
    private function report()
    {
        if (isset($_GET['commentId']) && isset($_GET['postId'])) {
            $affectedComment = $this->commentsManager->setReportComment($_GET['commentId']);

            if ($affectedComment === false) {
                throw new Exception('Action impossible');
            } else {
                header('Location: post&postId='.$_GET['postId']);
                exit();
            }
        } else {
            throw new Exception($this->datasError);
        }
    }
}