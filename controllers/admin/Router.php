<?php
require_once 'views/admin/View.php';
require_once 'services/LoginService.php';

class Router
{
    private $ctrl;
    private $view;

    public function routeReq()
    {
        try {
            spl_autoload_register(function($class) {
                require_once('models/' . $class . '.php');
            });

            $url = '';
            
            if (LoginService::isAdmin()) {
                if (isset($_GET['url'])) {
                    $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                    $controller = ucfirst(strtolower($url[0]));
                    $controllerClass = $controller . 'Controller';
                    $controllerFile = 'controllers/admin/'. $controllerClass . '.php';

                    if (file_exists($controllerFile) && count($url) === 1) {
                        require_once($controllerFile);
                        $this->ctrl = new $controllerClass();
                    } else {
                        throw new \Exception("Page introuvable", 1);
                    }
                } else {
                    require_once('controllers/admin/DashboardController.php');
                    $this->ctrl = new DashboardController();
                }
            } else {
                header('Location: index.php');
                exit();
            }

        } catch (\Exception $e) {
            $this->view = new View('error');
            $errorMessage = $e->getMessage();
            $this->view->generate(array('errorMessage' => $errorMessage));
        }
    }
}