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
        $this->postsManager = new PostsManager();
        $this->categoryManager = new CategoryManager();

        $this->home();
    }

    private function home()
    {
        // GET PAGINATION
        $page = $_GET['page'] ?? 1;
        if(!filter_var($page, FILTER_VALIDATE_INT)) {
            throw new \Exception('Numéro de page invalide');
        }

        if ($page === '1') {
            header ('Location: home');
            http_response_code(301);
            exit();
        }

        $currentPage = (int)$page;

        if ($currentPage <= 0) {
            throw new \Exception('Numéro de page invalide');
        }
        
        $count = $this->postsManager->getPublicPostsNumber();
        $pages = ceil($count / $this->postPerPage);

        if ($currentPage > $pages) {
            throw new \Exception('Cette page n\'existe pas');
        }

        $offset = $this->postPerPage * ($currentPage - 1);
        $posts = $this->postsManager->getPublicPostsPagination($this->postPerPage, $offset);

        // GET CATEGORIES
        $categories = $this->categoryManager->getAllCategories();

        // CALL THE VIEW
        $this->view = new View('home');
        $this->view->generate(array('posts' => $posts, 'categories' => $categories, 'pages' => $pages, 'currentPage' => $currentPage), $categories);
    }
}