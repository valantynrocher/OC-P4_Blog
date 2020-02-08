<?php 
require_once 'views/admin/View.php';

class DeletepostController {

    private $_postsManager;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) < 1) {
            throw new \Exception('Page introuvable');
        }
        else {
            $this->deletePost();
        }
    }

    private function deletePost() {
        if (isset($_GET['id'])) {
            $this->_postsManager = new PostsManager();
            $deletedPost = $this->_postsManager->setDeletePost($_GET['id']);
            var_dump($deletedPost);

            if($deletedPost === false)
            {
                throw new \Exception("Impossible de supprimer l\'article !");
            }
            else 
            {
                header('Location: admin.php?url=posts');
                exit();
            }
        }
    }    
}