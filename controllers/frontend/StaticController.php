<?php
namespace JeanForteroche\Controllers\Frontend;

use JeanForteroche\Views\View;
use JeanForteroche\Controllers\Controller;

class StaticController extends Controller
{
    public function index()
    {
        // no index page
    }

    /**
     * Action 'contact'
     * Generates view for contact page
     */
    public function contact()
    {
        $this->generateView(array());
    }

    /**
     * Action 'about'
     * Generates view for about page
     */
    public function about()
    {
        $this->generateView(array());
    }

    /**
     * Action 'legals'
     * Generates view for legals mentions page
     */
    public function legals()
    {
        $this->generateView(array());
    }
}