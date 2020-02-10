<?php
require_once 'views/frontend/View.php';

class HomeController
{
    private $postsManager;
    private $categoryManager;
    private $postPerPage = 5;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        } else {
            $this->posts();
        }
    }

    private function posts()
    {
        $this->postsManager = new PostsManager();

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

        $count = $this->postsManager->getPostsNumber();
        $pages = ceil($count / $this->postPerPage);
        if ($currentPage > $pages) {
            throw new \Exception('Cette page n\'existe pas');
        }

        $offset = $this->postPerPage * ($currentPage - 1);

        $posts = $this->postsManager->getPostsPages($this->postPerPage, $offset);

        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getCategories();

        $this->view = new View('home');
        $this->view->generate(array('posts' => $posts, 'categories' => $categories, 'pages' => $pages, 'currentPage' => $currentPage));
    }
}