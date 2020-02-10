<?php
require_once 'views/frontend/View.php';

class LegalsController
{

    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        } else {
            $this->legals();
        }
    }

    private function legals()
    {
        $this->view = new View('legals');
        $this->view->generate(array());
    }
}