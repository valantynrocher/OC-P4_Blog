<?php 
require_once 'views/admin/View.php';

class UpdatepostController
{

    private $postsManager;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->updatePost();
        }
    }

    private function updatePost() 
    {
        if (isset($_GET['id']) && isset($_POST['title']) && isset($_POST['categoryId']) && isset($_POST['content'])) {

            $this->postsManager = new PostsManager();
            $affectedPost = $this->postsManager->setUpdatePost($_GET['id'], $_POST['title'], $_POST['categoryId'], $_POST['content']);

            if($affectedPost === false) {
                throw new Exception("Impossible de mettre à jour l\'article !");
            } else  {
                header('Location: admin.php?url=posts');
                exit();
            }
        }
    }    
}