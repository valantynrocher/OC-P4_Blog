<?php
require_once 'views/frontend/View.php';

class AboutController
{

    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        } else {
            $this->about();
        }
    }

    private function about()
    {
        $this->view = new View('about');
        $this->view->generate(array());
    }
}