<?php
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class CategoryController extends Controller
{
    /**
     * Manager for posts
     */
    private $postsManager;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
    }

    /**
     * Action 'index' (default)
     * Generates view to show one category with related posts
     */
    public function index()
    {
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];
            $postsByCategory = $this->postsManager->getPublicPostsByCategory($categoryId);
            $category = $this->getCategoryManager()->getOneCategory($categoryId);
    
            $this->generateView(array(
                'postsByCategory' => $postsByCategory,
                'category' => $category,
                'categories' => $this->getCategories()
            ));
        } else {
            throw new Exception($this->datasError);
        }
    }
}