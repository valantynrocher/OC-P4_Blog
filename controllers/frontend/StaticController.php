<?php
namespace JeanForteroche\Controllers\Frontend;

use JeanForteroche\Controllers\Controller;
use JeanForteroche\Services\Email;

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
        // Init alert params
        $alert = null;

        if (isset($_GET['alert'])) {
            $alert = htmlspecialchars(strip_tags($_GET['alert']));
            switch($alert) {
                
            }
        }

        $this->generateView(array());
    }


    /**
     * Action 'email'
     * Send email from contact form
     */
    public function email()
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
            Email::contactEmail($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
        } else {
            throw new Exception($this->datasError);
        }
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

    /**
     * Action 'cookies'
     * Generates view for cookies policy page
     */
    public function cookies()
    {
        $this->generateView(array());
    }
}