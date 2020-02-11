<?php
require_once 'views/frontend/View.php';

class HomeController
{
    private $postsManager;
    private $categoryManager;
    private $postPerPage = 5;
    private $view;

    public function __construct($url)
    {
            $this->home();
    }

    private function home()
    {
        // GESTION DE LA PAGINATION
        $page = $_GET['page'] ?? 1;
        // vérifie que le numéro de page est un entier
        if(!filter_var($page, FILTER_VALIDATE_INT)) {
            throw new \Exception('Numéro de page invalide');
        }
        // redirection de page=1 vers home
        if ($page === '1') {
            header ('Location: home');
            http_response_code(301);
            exit();
        }
        $currentPage = (int)$page;
        if ($currentPage <= 0) {
            throw new \Exception('Numéro de page invalide');
        }
        $this->postsManager = new PostsManager();
        $count = $this->postsManager->getPostsNumber();
        $pages = ceil($count / $this->postPerPage);
        if ($currentPage > $pages) {
            throw new \Exception('Cette page n\'existe pas');
        }
        $offset = $this->postPerPage * ($currentPage - 1);
        $posts = $this->postsManager->getPostsPages($this->postPerPage, $offset);

        // RECCUPERATION DES CATEGORIES
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getCategories();

        // APPEL DE LA VUE
        $this->view = new View('home');
        $this->view->generate(array('posts' => $posts, 'categories' => $categories, 'pages' => $pages, 'currentPage' => $currentPage), $categories);
    }
}