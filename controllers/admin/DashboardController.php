<?php 
require_once 'views/admin/View.php';

class DashboardController
{

    private $postsManager;
    private $commentsManager;
    private $categoriesManager;
    private $usersManager;
    private $view;

    public function __construct()
    {
        $this->dashboard();
    }

    private function dashboard()
    {
        print_r($_SESSION);
        // POSTS
        $this->postsManager = new PostsManager();
        $lastFivesPublicsPosts = $this->postsManager->getLastFivePublicsPosts();
        $publicPostsNumber = $this->postsManager->getPublicPostsNumber();
        $progressPostsNumber = $this->postsManager->getProgressPostsNumber();

        // COMMENTS
        $this->commentsManager = new CommentsManager();
        $lastFivePublicsComments = $this->commentsManager->getLastFivePublicsComments();
        $reportCommentsNumber = $this->commentsManager->getReportCommentsNumber();
        $waitingCommentsNumber = $this->commentsManager->getWaitingCommentsNumber();

        // CATEGORIES
        $this->categoriesManager = new CategoryManager();
        $lastFiveCategories = $this->categoriesManager->getLastFiveCategories();
        $categoriesNumber = $this->categoriesManager->getCategoriesNumber();

        // USERS
        $this->usersManager = new UsersManager();
        $lastFiveUsers = $this->usersManager->getLastFiveUsers();
        $adminUsersNumber = $this->usersManager->getAdminUsersNumber();
        $readerUsersNumber = $this->usersManager->getReaderUsersNumber();

        // VIEW
        $this->view = new View('dashboard');
        $this->view->generate(array(
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