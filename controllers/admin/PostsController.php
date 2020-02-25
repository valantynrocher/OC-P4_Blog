<?php 
require_once 'views/admin/View.php';

class PostsController
{
    private $postsManager;
    public $posts;
    private $categoryManager;
    public $categories;
    private $view;
    public $actionError = 'Action impossible : des données n\'ont pas été transmises';

    public function __construct()
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listPosts();
                break;
            case 'create':
                $this->createPost();
                break;
            case 'insert':
                if (isset($_POST['postTitle']) && isset($_POST['categoryId']) && isset($_POST['postContent']) ) {
                    $this->insertPost($_POST['postTitle'], $_POST['categoryId'], $_POST['postContent'], $_POST['postStatus']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            case 'read':
                if (isset($_GET['postId'])) {
                    $this->readPost($_GET['postId']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            case 'edit':
                if (isset($_GET['postId'])) {
                    $this->editPost($_GET['postId']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            case 'update':
                if (isset($_GET['postId']) && isset($_POST['postTitle']) && isset($_POST['categoryId']) && isset($_POST['postContent']) && isset($_POST['postStatus'])) {
                    $this->updatePost($_GET['postId'], $_POST['postTitle'], $_POST['categoryId'], $_POST['postContent'], $_POST['postStatus']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            case 'trash':
                if (isset($_GET['postId'])) {
                    $this->trashPost($_GET['postId']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            case 'delete':
                if (isset($_GET['postId'])) {
                    $this->deletePost($_GET['postId']);
                } else {
                    throw new \Exception($this->actionError);
                }
                break;
            default:
                throw new Exception('Action impossible !');
        }
        
    }

    private function listPosts()
    {
        $this->postsManager = new PostsManager();
        $this->posts = $this->postsManager->getAllPosts();

        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getAllCategories();

        $this->view = new View('posts/listPosts');
        $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories));       
    }

    private function createPost()
    {
        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getAllCategories();
                    
        $this->view = new View('posts/createPost');
        $this->view->generate(array('categories' => $this->categories));
    }

    private function insertPost($postTitle, $categoryId, $postContent, $postStatus)
    {
        $this->postsManager = new PostsManager();
        $newPost = $this->postsManager->setNewPost($postTitle, $categoryId, $postContent, $postStatus);
    
        if($newPost === false) {
            throw new \Exception("Impossible d'ajouter l\'article !");
        } else {
            header('Location: admin.php?url=posts&action=list');
            exit();
        }
    }

    private function readPost($postId)
    {
        $this->postsManager = new PostsManager();
        $this->posts = $this->postsManager->getAllPosts();

        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getAllCategories();

        $postToRead = $this->postsManager->getOnePost($postId);

        $this->view = new View('posts/readPost');
        $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories, 'postToRead' => $postToRead));
    }

    private function editPost($postId)
    {
        $this->postsManager = new PostsManager();
        $this->posts = $this->postsManager->getAllPosts();

        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getAllCategories();
            
        $postToUpdate = $this->postsManager->getOnePost($postId);

        $this->view = new View('posts/editPost');
        $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories, 'postToUpdate' => $postToUpdate));
    }

    private function updatePost($postId, $postTitle, $categoryId, $postContent, $postStatus) 
    {
        $this->postsManager = new PostsManager();
        $affectedPost = $this->postsManager->setChangedPost($postId, $postTitle, $categoryId, $postContent, $postStatus);

        if($affectedPost === false) {
            throw new Exception("Impossible de mettre à jour l\'article !");
        } else  {
            header('Location: admin.php?url=posts&action=list');
            exit();
        }
    }

    private function trashPost($postId)
    {
        $this->postsManager = new PostsManager();
        $trashedPost = $this->postsManager->setTrashedPost($postId);

        if($trashedPost === false) {
            throw new \Exception("Impossible de mettre l\'article à la corbeille !");
        } else {
            header('Location: admin.php?url=posts&action=list');
            exit();
        }
    }

    private function deletePost($postId)
    {
        $this->postsManager = new PostsManager();
        $deletedPost = $this->postsManager->setPostDeleted($postId);

        if($deletedPost === false) {
            throw new \Exception("Impossible de supprimer l\'article !");
        } else {
            header('Location: admin.php?url=posts&action=list');
            exit();
        }
    }

}