<?php
require_once 'services/Request.php';
require_once 'views/View.php';
require_once 'services/Login.php';

class Router
{
    /**
     * Define wich side for controllers and views
     * Refer to base files in "/" to know wich sides are allowed
     */
    private $side;

    public function __construct()
    {
        $this->side = $this->getRoadSide();
    }

    /**
     * Get the side to give to controllers or views
     * @return String $side
     * if index.php is called, $side = 'frontend'
     * if admin.php is called, $side = 'admin'
     */
    private function getRoadSide()
    {
        $phpSelf = $_SERVER['PHP_SELF'];
        if (stristr($phpSelf, 'index.php')) {
            $side = 'frontend';
        } else if (stristr($phpSelf, 'admin.php')) {
            $side = 'admin';
        } else {
            throw new \Exception('Erreur du serveur (refer to PHP_SELF) !');
        }
        return $side;
    }


    /**
     * Make a request : execute the associated action
     * @return void
     */
    public function routeReq()
    {
        try {
            spl_autoload_register(function($class) {
                require_once 'models/' . $class . '.php';
            });

            $request = new Request(array_merge($_GET, $_POST));
            
            $controller = $this->createController($request);
            
            $action = $this->createAction($request);
            
            $controller->setViewSide($this->side);
            
            $controller->startAction($action);
            
        } catch (\Exception $e) {
            $this->getError($e);
        }
    }

    /**
     * Create the good controller according to the request received
     * @param Object $req
     * @return Object $controller
     */
    private function createController(Request $req)
    {
        $controller = 'Home'; // Default controller
        if ($req->issetSettings('url')) {
            $controller = $req->getSettings('url');
            $controller = ucfirst(strtolower($controller));
        }

        $controllerClass = $controller . 'Controller';

        if ($this->side === 'frontend') {
            return $this->callController('frontend', $controllerClass, $req);
        } else if ($this->side === 'admin') {
            if (Login::isAdmin()) {
                return $this->callController('admin', $controllerClass, $req);
            } else {
                header('Location: home');
                exit();
            }
        } else {
            throw new \Exception('Une erreur est survenue (cf PHP_SELF).');
        }
    }

    /**
     * Return the controller to create
     * @param String $controllerSide
     * @param String $controllerClass
     * @param Object $req
     * @return Object $controller
     */
    private function callController($controllerSide, $controllerClass, Request $req)
    {
        $controllerFile = 'controllers/'.$controllerSide.'/'.$controllerClass.'.php';
        
        if (file_exists($controllerFile)) {
            require($controllerFile);
            $controller = new $controllerClass();
            $controller->setRequest($req);            
            return $controller;
        } else {
            throw new \Exception("Le fichier $controllerFile est introuvable", 1);
        }
    }

    /**
     * Define action to execute according to the request received
     * @param Object $req
     * @return String $action
     */
    private function createAction(Request $req)
    {
        $action = 'index'; // Default action
        if ($req->issetSettings('action')) {
            $action = $req->getSettings('action');
        }
        return $action;
    }

    /**
     * Manage request exuecution error (exception)
     * Generate the error view and send it the error messages
     * @param Object $exception (PHP)
     * @return void
     */
    private function getError(Exception $exception)
    {
        $this->view = new View('404', $this->side);
        $this->view->generate(array('errorMsg' => $exception->getMessage()), '');
    }
}