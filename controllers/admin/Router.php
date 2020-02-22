<?php
require_once 'views/admin/View.php';

class Router
{
    private $ctrl;
    private $view;

    public function isConnected():bool
    {
        return !empty($_SESSION['connected']);
    }

    public function routeReq()
    {
        try {
            // chargement auto des class models (managers)
            spl_autoload_register(function($class) {
                require_once('models/' . $class . '.php');
            });

            $url = '';

            // L'utilisateur n'est pas connecté
            if (!$this->isConnected()) {
                require_once('controllers/admin/AuthController.php');
                $this->ctrl = new AuthController($url);
                exit();
            } else {
                // L'utilisateur est connecté
                
                // détermine le controleur selon ce qui est passé dans l'url
                if (isset($_GET['url'])) {
                    // décomposition de l'url et application d'un filtre
                    // ex : accueil/articles => [acceuil, articles]
                    $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL)); // renvoie un array

                    // création dynamique du controller et de son fichier
                    $controller = ucfirst(strtolower($url[0]));
                    $controllerClass = $controller . 'Controller';
                    $controllerFile = 'controllers/admin/'. $controllerClass . '.php';

                    // vérifie si le fichier existe
                    if (file_exists($controllerFile) && count($url) === 1) {
                        require_once($controllerFile);
                        $this->ctrl = new $controllerClass($url);
                    } else {
                        throw new \Exception("Page introuvable", 1);
                    }
                } else {
                    require_once('controllers/admin/DashboardController.php');
                    $this->ctrl = new DashboardController($url);
                }
            }
        } catch (\Exception $e) {
            $this->view = new View('error');
            $errorMessage = $e->getMessage();
            $this->view->generate(array('errorMessage' => $errorMessage));
        }
    }
}