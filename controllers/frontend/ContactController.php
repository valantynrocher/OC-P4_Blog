<?php
require_once 'views/frontend/View.php';

class ContactController
{

    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        } else {
            $this->contact();
        }
    }

    private function contact()
    {
        $this->view = new View('contact');
        $this->view->generate(array());
    }
}