<?php 
require_once 'views/admin/View.php';

class PostsController
{
    private $postsManager;
    public $posts;
    private $categoryManager;
    public $categories;
    private $view;

    public function __construct()
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'list':
                $this->listPosts();
                break;
            case 'read':
                $this->readPost($_GET['id']);
                break;
            case 'edit':
                $this->editPost($_GET['id']);
                break;
            case 'update':
                $this->updatePost($_GET['id'], $_POST['title'], $_POST['categoryId'], $_POST['content']);
                break;
            case 'delete':
                $this->deletePost($_GET['id']);
                break;
            default:
                throw new Exception('Action inconnue');
        }
        
    }

    private function listPosts()
    {
        $this->postsManager = new PostsManager();
        $this->posts = $this->postsManager->getPosts();

        $this->categoryManager = new CategoryManager();
        $this->categories = $this->categoryManager->getCategories();

        $this->view = new View('posts');
        $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories));       
    }

    private function readPost($id)
    {
        if (isset($id)) {
            $this->postsManager = new PostsManager();
            $this->posts = $this->postsManager->getPosts();

            $this->categoryManager = new CategoryManager();
            $this->categories = $this->categoryManager->getCategories();

            $postToRead = $this->postsManager->getPost($id);

            $this->view = new View('posts');
            $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories, 'postToRead' => $postToRead));
        }
    }

    private function editPost($id)
    {
        if (isset($id)) {
            $this->postsManager = new PostsManager();
            $this->posts = $this->postsManager->getPosts();

            $this->categoryManager = new CategoryManager();
            $this->categories = $this->categoryManager->getCategories();
            
            $postToUpdate = $this->postsManager->getPost($id);

            $this->view = new View('posts');
            $this->view->generate(array('posts' => $this->posts, 'categories' => $this->categories, 'postToUpdate' => $postToUpdate));
        }
    }

    private function updatePost($id, $title, $categoryId, $content) 
    {
        if (isset($id) && isset($title) && isset($categoryId) && isset($content)) {
            $this->postsManager = new PostsManager();
            $affectedPost = $this->postsManager->setUpdatePost($id, $title, $categoryId, $content);

            if($affectedPost === false) {
                throw new Exception("Impossible de mettre à jour l\'article !");
            } else  {
                header('Location: admin.php?url=posts&action=list');
                exit();
            }
        }
    }

    private function deletePost($id)
    {
        if (isset($id)) {
            $this->postsManager = new PostsManager();
            $deletedPost = $this->postsManager->setDeletePost($id);

            if($deletedPost === false) {
                throw new \Exception("Impossible de supprimer l\'article !");
            } else {
                header('Location: admin.php?url=posts&action=list');
                exit();
            }
        }
    }

}