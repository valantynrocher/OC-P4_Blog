<?php

class Login
{
    /**
   * @var Login
   * @access private
   * @static
   */
   private static $_instance = null;
 
   /**
    * Class constructor
    *
    * @param void
    * @return void
    */
   private function __construct() {  
   }
 
   /**
    * Methode to create the single class instance
    * if doesn't exist yet and return it
    *
    * @param void
    * @return Login
    */
   public static function getInstance() {
 
     if(is_null(self::$_instance)) {
       self::$_instance = new Login();  
     }
 
     return self::$_instance;
   }

   /**
    * Method to know if user is connected
    *
    * @return bool
    */
    public static function isConnected()
    {
        if (isset($_SESSION['connected'])) {
            return true;
        }
    }

   /**
    * Method to know if user is an Admin
    *
    * @return bool
    */
    public static function isAdmin()
    {
        if ($_SESSION['user']['role'] === 'admin') {
            return true;
        }
    }

    /**
     * Method to know if user is a Reader
     *
    * @return bool
    */
    public static function isReader()
    {
        if ($_SESSION['user']['role'] === 'reader') {
            return true;
        }
    }
    
}