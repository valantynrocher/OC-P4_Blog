<?php
require_once 'views/frontend/View.php';

class AboutController {

    private $_view;

    public function __construct() {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable', 1);
        }
        else {
            $this->about();
        }
    }

    private function about() {
        $this->_view = new View('about');
        $this->_view->generate(array());
    }
}