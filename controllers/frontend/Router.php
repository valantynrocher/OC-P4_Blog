<?php
require_once 'views/frontend/View.php';

class Router {
    private $ctrl;
    private $view;

    public function routeReq() {
        try {
            // chargement auto des class models (managers)
            spl_autoload_register(function($class) {
                require_once('models/' . $class . '.php');
            });

            $url = '';

            // détermine le controleur selon ce qui est passé dans l'url
            if (isset($_GET['url'])) {
                // décomposition de l'url et application d'un filtre
                // ex : url=home accueil/articles => [acceuil, articles]
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL)); // renvoie un array

                $controller = ucfirst(strtolower($url[0]));

                $controllerClass = $controller . 'Controller';

                // on retrouve le chemin du controleur cherché
                $controllerFile = 'controllers/frontend/'. $controllerClass . '.php';

                // vérifie si le fichier existe
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);
                }
                else {
                    throw new \Exception("Page introuvable", 1);
                }
            }
            else {
                require_once('controllers/frontend/HomeController.php');
                $this->ctrl = new HomeController($url);
            }
        }
        catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $this->view = new View('error');
            $this->view->generate(array('error' => $errorMessage));
        }
    }
}