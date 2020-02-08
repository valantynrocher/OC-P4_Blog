<?php
require_once 'views/frontend/View.php';

class HomeController {
    private $_postsManager;
    private $_categoryManager;
    private $_postPerPage = 5;
    private $_view;

    public function __construct() {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        }
        else {
            $this->posts();
        }
    }

    private function posts() {
        $this->_postsManager = new PostsManager();

        $page = $_GET['page'] ?? 1;
        // vérifier que le numéro de page est un entier
        if(!filter_var($page, FILTER_VALIDATE_INT)) {
            throw new \Exception('Numéro de page invalide');
        }

        // faire en sorte que page=1 soit redirigé vers home
        if ($page === '1') {
            header ('Location: home');
            http_response_code(301);
            exit();
        }

        $currentPage = (int)$page;
        if ($currentPage <= 0) {
            throw new \Exception('Numéro de page invalide');
        }

        $count = $this->_postsManager->getPostsNumber();
        $pages = ceil($count / $this->_postPerPage);
        if ($currentPage > $pages) {
            throw new \Exception('Cette page n\'existe pas');
        }

        $offset = $this->_postPerPage * ($currentPage - 1);

        $posts = $this->_postsManager->getPostsPages($this->_postPerPage, $offset);

        $this->_categoryManager = new CategoryManager();
        $categories = $this->_categoryManager->getCategories();

        $this->_view = new View('home');
        $this->_view->generate(array('posts' => $posts, 'categories' => $categories, 'pages' => $pages, 'currentPage' => $currentPage));
    }
}