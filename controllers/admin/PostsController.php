<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class PostsController extends Controller
{
    /**
     * Manager for posts
     */    
    private $postsManager;

    /**
     * Posts returned with databse
     */    
    public $posts;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
    }

    /**     
     * Action 'index' (default)
     * Generates view for to list posts
     */
    public function index()
    {
        $this->posts = $this->postsManager->getAllPosts();

        $this->categories = $this->getCategories();

        $this->generateView(array(
            'posts' => $this->posts,
            'categories' => $this->categories
        ));       
    }

    /**
     * Action 'create'
     * Generates view for new post page
     */
    public function create()
    {
        $this->categories = $this->getCategories();
                    
        $this->generateView(array(
            'categories' => $this->categories
        ));
    }

    /**
     * Action 'read'
     * Generates view for read post page
     */
    public function read()
    {
        if (isset($_GET['postId'])) {
            $this->posts = $this->postsManager->getAllPosts();

            $this->categories = $this->getCategories();
    
            $postToRead = $this->postsManager->getOnePost($_GET['postId']);
    
            $this->generateView(array(
                'posts' => $this->posts,
                'categories' => $this->categories,
                'postToRead' => $postToRead
            ));
        } else {
            throw new \Exception($this->datasError);
        }
    }

    /**
     * Action 'edit'
     * Generates view for edit post page
     */
    public function edit()
    {
        if (isset($_GET['postId'])) {
            $this->posts = $this->postsManager->getAllPosts();

            $this->categories = $this->getCategories();
                
            $postToUpdate = $this->postsManager->getOnePost($_GET['postId']);
    
            $this->generateView(array(
                'posts' => $this->posts,
                'categories' => $this->categories,
                'postToUpdate' => $postToUpdate
            ));
        } else {
            throw new \Exception($this->datasError);
        }
    }

    /**
     * Action 'insert'
     * Call Post Manager to insert new post in databse
     * Redirect on index
     */
    public function insert()
    {
        if (isset($_POST['postTitle']) && isset($_POST['categoryId']) && isset($_POST['postContent']) ) {
            $newPost = $this->postsManager->setNewPost($_POST['postTitle'], $_POST['categoryId'], $_POST['postContent'], $_POST['postStatus']);
    
            if($newPost === false) {
                throw new \Exception("Impossible d'ajouter l\'article !");
            } else {
                header('Location: admin.php?url=posts');
                exit();
            }
        } else {
            throw new \Exception($this->datasError);
        }
    }

    /**
     * Action 'update'
     * Call Post Manager to update one post in databse
     * Redirect on index
     */
    public function update() 
    {
        if (isset($_GET['postId']) && isset($_POST['postTitle']) && isset($_POST['categoryId']) && isset($_POST['postContent']) && isset($_POST['postStatus'])) {
            $affectedPost = $this->postsManager->setChangedPost($_GET['postId'], $_POST['postTitle'], $_POST['categoryId'], $_POST['postContent'], $_POST['postStatus']);

            if($affectedPost === false) {
                throw new Exception("Impossible de mettre à jour l\'article !");
            } else  {
                header('Location: admin.php?url=posts');
                exit();
            }
        } else {
            throw new \Exception($this->datasError);
        }
    }

    /**
     * Action 'trash'
     * Call Post Manager to set trashed post in databse
     * Redirect on index
     */
    public function trash()
    {
        if (isset($_GET['postId'])) {
            $trashedPost = $this->postsManager->setTrashedPost($_GET['postId']);

            if($trashedPost === false) {
                throw new \Exception("Impossible de mettre l\'article à la corbeille !");
            } else {
                header('Location: admin.php?url=posts');
                exit();
            }
        } else {
            throw new \Exception($this->datasError);
        }
    }

    /**
     * Action 'delete'
     * Call Post Manager to delete one post in databse
     * Redirect on index
     */
    public function delete()
    {
        if (isset($_GET['postId'])) {
            $deletedPost = $this->postsManager->setPostDeleted($_GET['postId']);

            if($deletedPost === false) {
                throw new \Exception("Impossible de supprimer l\'article !");
            } else {
                header('Location: admin.php?url=posts');
                exit();
            }
        } else {
            throw new \Exception($this->datasError);
        }
    }

}