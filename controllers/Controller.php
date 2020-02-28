<?php

require_once 'services/Request.php';
require_once 'views/View.php';

abstract class Controller {

  /**
   * Action to execute
   * @param String
   */
  private $action;

  /**
   * Asked request
   * @param Request
   */
  protected $request;

  /**
   * Side admin or frontend
   */
  private $side;

  /**
   * Error message called if datas ($_GET or $_POST) are not set
   * @param String
   */
  protected $datasError = '<i class="fas fa-exclamation-circle"></i> Action impossible : des données n\'ont pas été transmises';

  /**
   * Category Manager
   * @param Category
   */
  protected $categoryManager;

  /**
   * Categories get by db request
   * @param Array
   */
  protected $categories;

  /**
   * Set asked request
   */
  public function setRequest(Request $request) {
    $this->request = $request;
  }

  /**
   * Set view side
   */
  public function setViewSide($side)
  {
    $this->side = $side;
  }

  /**
   * Execute action
   */
  public function startAction($action) {
    if (method_exists($this, $action)) {
      $this->action = $action;
      $this->{$this->action}();
    }
    else {
      $controllerClass = get_class($this);
      throw new Exception("Action '$action' non définie dans la classe $controllerClass");
    }
  }

  /**
   * Abstract method called for default action in controller
   * Each inherits controller must implement this method
   */
  public abstract function index();

  /**
   * Function to get Category Manager
   */
  protected function getCategoryManager()
  {
    $this->categoryManager = new CategoryManager();
    return $this->categoryManager;
  }

  /**
   * Function to get all categories
   */
  protected function getCategories()
  {
    $this->categories = $this->getCategoryManager()->getAllCategories();
    return $this->categories;
  }

  /**
   * Generates the view according to current controller
   */
  protected function generateView(array $datas) {
    // Define view's file name according to current controller's name
    $controllerClass = get_class($this);
    $controller = str_replace("Controller", "", $controllerClass);
    
    $view = new View($this->action, $this->side, $controller);
    $view->generate($datas, $this->getCategories());
  }
}