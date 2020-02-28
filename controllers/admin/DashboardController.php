<?php 
require_once 'views/View.php';
require_once 'controllers/Controller.php';

class DashboardController extends Controller
{
    /**
     * Manager for posts
     */
    private $postsManager;

    /**
     * Manager for comments
     */
    private $commentsManager;

    /**
     * Manager for users
     */
    private $usersManager;

    public function __construct()
    {
        $this->postsManager = new PostsManager();
        $this->commentsManager = new CommentsManager();
        $this->usersManager = new UsersManager();
    }

    /**
     * Action 'index' (default)
     * Generates view for dashboard page
     */
    public function index()
    {
        // POSTS
        $lastFivesPublicsPosts = $this->postsManager->getLastFivePublicsPosts();
        $publicPostsNumber = $this->postsManager->getPublicPostsNumber();
        $progressPostsNumber = $this->postsManager->getProgressPostsNumber();

        // COMMENTS
        $lastFivePublicsComments = $this->commentsManager->getLastFivePublicsComments();
        $reportCommentsNumber = $this->commentsManager->getReportCommentsNumber();
        $waitingCommentsNumber = $this->commentsManager->getWaitingCommentsNumber();

        // CATEGORIES
        $lastFiveCategories = $this->getCategoryManager()->getLastFiveCategories();
        $categoriesNumber = $this->getCategoryManager()->getCategoriesNumber();

        // USERS
        $lastFiveUsers = $this->usersManager->getLastFiveUsers();
        $adminUsersNumber = $this->usersManager->getAdminUsersNumber();
        $readerUsersNumber = $this->usersManager->getReaderUsersNumber();

        // VIEW
        $this->generateView(array(
            'lastFivesPublicsPosts' => $lastFivesPublicsPosts,
            'publicPostsNumber' => $publicPostsNumber,
            'progressPostsNumber' => $progressPostsNumber,

            'lastFivePublicsComments' => $lastFivePublicsComments,
            'reportCommentsNumber' => $reportCommentsNumber,
            'waitingCommentsNumber' => $waitingCommentsNumber,

            'lastFiveCategories' => $lastFiveCategories,
            'categoriesNumber' => $categoriesNumber,

            'lastFiveUsers' => $lastFiveUsers,
            'adminUsersNumber' => $adminUsersNumber,
            'readerUsersNumber' => $readerUsersNumber
        ));
    }
}