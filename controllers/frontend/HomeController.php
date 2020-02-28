<?php
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class HomeController extends Controller
{
    /**
     * Manager for posts
     */
    private $postsManager;

    /**
     * Value of post to show on the home page
     * @param Int
     */
    private $postPerPage = 5;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
    }

    /**
     * Action Index (default)
     * Generates view for home page
     * @return void
     */
    public function index()
    {
        $currentPage = $this->checkCurrentPage();
        if ($currentPage <= 0) {
            throw new \Exception('Numéro de page invalide');
        }

        // Check if current page exist
        $pagesCount = $this->getPagesCount();
        if ($currentPage > $pagesCount) {
            throw new \Exception('Cette page n\'existe pas');
        }

        // Call the view
        $this->generateView(array('posts' => $this->getPosts($currentPage), 'categories' => $this->getCategories(), 'pages' => $pagesCount, 'currentPage' => $currentPage));
    }

    /**
     * Check if asked page is valid
     * @return Int $currentPage : current page number
     */
    private function checkCurrentPage()
    {
        $reqPage = $_GET['page'] ?? 1;
        if(!filter_var($reqPage, FILTER_VALIDATE_INT)) {
            throw new \Exception('Numéro de page invalide');
        }

        if ($reqPage === '1') {
            header ('Location: home');
            http_response_code(301);
            exit();
        }
        $currentPage = (int)$reqPage;
        return $currentPage;
    }

    /**
     * Get number of pages
     * @return Int $pagesCount : number of pages
     */
    private function getPagesCount()
    {
        $count = $this->postsManager->getPublicPostsNumber();
        $pagesCount = ceil($count / $this->postPerPage);

        return $pagesCount;
    }

    /**
     * Get Posts to show by page
     * @param Int
     * @return Array $posts : all Post Objects
     */
    private function getPosts($currentPage)
    {
        $offset = $this->postPerPage * ($currentPage - 1);
        $posts = $this->postsManager->getPublicPostsPagination($this->postPerPage, $offset);
        return $posts;
    }
}