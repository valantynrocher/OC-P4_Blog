<?php
namespace JeanForteroche\Controllers\Frontend;

use JeanForteroche\Views\View;
use JeanForteroche\Controllers\Controller;
use JeanForteroche\Models\PostsManager;
use \Exception;

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
            $categoryId = htmlspecialchars(strip_tags((int)$_GET['categoryId']));

            if (filter_var($categoryId, FILTER_VALIDATE_INT)) {
                $posts = $this->postsManager->getPublicPostsByCategory($categoryId);
                $category = $this->getCategoryManager()->getOneCategory($categoryId);
        
                $this->generateView(array(
                    'posts' => $posts,
                    'category' => $category,
                    'categories' => $this->getCategories()
                ));
            } else {
                throw new Exception($this->datasError);
            }
        } else {
            throw new Exception($this->datasError);
        }
    }
}