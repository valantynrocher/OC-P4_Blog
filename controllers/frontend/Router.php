<?php
require_once 'views/frontend/View.php';

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

            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));

                $controllerClass = $controller . 'Controller';

                $controllerFile = 'controllers/frontend/'. $controllerClass . '.php';

                if (file_exists($controllerFile) && count($url) === 1) {
                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);
                } else {
                    throw new \Exception("Page introuvable", 1);
                }
            } else {
                require_once('controllers/frontend/HomeController.php');
                $this->ctrl = new HomeController($url);
            }
        } catch (\Exception $e) {
            $this->view = new View('error');
            $errorMessage = $e->getMessage();
            $this->view->generate(array('errorMessage' => $errorMessage));
        }
    }
}