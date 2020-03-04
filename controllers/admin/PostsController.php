<?php
namespace JeanForteroche\Controllers\Admin;

use JeanForteroche\Controllers\Controller;
use JeanForteroche\Views\View;
use JeanForteroche\Models\PostsManager;
use \Exception;

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
        $this->generateView(array(
            'categories' => $this->getCategories()
        ));
    }

    /**
     * Action 'read'
     * Generates view for read post page
     */
    public function read()
    {
        if (isset($_GET['postId'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $this->posts = $this->postsManager->getAllPosts();    
                $postToRead = $this->postsManager->getOnePost($postId);
        
                $this->generateView(array(
                    'posts' => $this->posts,
                    'categories' => $this->getCategories(),
                    'postToRead' => $postToRead
                ));
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'edit'
     * Generates view for edit post page
     */
    public function edit()
    {
        if (isset($_GET['postId'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $this->posts = $this->postsManager->getAllPosts();
                $postToUpdate = $this->postsManager->getOnePost($postId);
                $this->generateView(array(
                    'posts' => $this->posts,
                    'categories' => $this->getCategories(),
                    'postToUpdate' => $postToUpdate
                ));
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }

    /**
     * Action 'insert'
     * Call Post Manager to insert new post in databse
     * Redirect on index
     */
    public function insert()
    {
        if (isset($_POST['submit']) ) {
            $postRank = htmlspecialchars(strip_tags((int)$_POST['postRank']));
            $categoryId = htmlspecialchars(strip_tags((int)$_GET['categoryId']));
            $postTitle = htmlspecialchars(strip_tags($_POST['postTitle']));
            $postContent = htmlspecialchars(strip_tags($_POST['postContent']));
            $postStatus = htmlspecialchars(strip_tags($_POST['postStatus']));

            if (filter_var($categoryId, FILTER_VALIDATE_INT)) {
                $newPost = $this->postsManager->setNewPost($postRank, $postTitle, $categoryId, $postContent, $postStatus);
    
                if($newPost === false) {
                    throw new Exception("Impossible d'ajouter l\'article !");
                } else {
                    header('Location: admin.php?url=posts');
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
     * Action 'update'
     * Call Post Manager to update one post in databse
     * Redirect on index
     */
    public function update() 
    {
        if (isset($_POST['submit'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));
            $postRank = htmlspecialchars(strip_tags((int)$_POST['postRank']));
            $categoryId = htmlspecialchars(strip_tags((int)$_POST['categoryId']));
            $postTitle = htmlspecialchars(strip_tags($_POST['postTitle']));
            $postContent = htmlspecialchars(strip_tags($_POST['postContent']));
            $postStatus = htmlspecialchars(strip_tags($_POST['postStatus']));

            if (filter_var($postId, FILTER_VALIDATE_INT))
            $affectedPost = $this->postsManager->setChangedPost($postId, $postRank, $postTitle, $categoryId, $postContent, $postStatus);

            if($affectedPost === false) {
                throw new Exception("Impossible de mettre à jour l\'article !");
            } else  {
                header('Location: admin.php?url=posts');
                exit();
            }
        } else {
            throw new Exception($this->datasError);
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
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $trashedPost = $this->postsManager->setTrashedPost($postId);

                if($trashedPost === false) {
                    throw new Exception("Impossible de mettre l\'article à la corbeille !");
                } else {
                    header('Location: admin.php?url=posts');
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
     * Call Post Manager to delete one post in databse
     * Redirect on index
     */
    public function delete()
    {
        if (isset($_GET['postId'])) {
            $postId = htmlspecialchars(strip_tags((int)$_GET['postId']));

            if (filter_var($postId, FILTER_VALIDATE_INT)) {
                $deletedPost = $this->postsManager->setPostDeleted($postId);

                if($deletedPost === false) {
                    throw new Exception("Impossible de supprimer l\'article !");
                } else {
                    header('Location: admin.php?url=posts');
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