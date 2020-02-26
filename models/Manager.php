<?php

require_once 'services/BddConfig.php';

abstract class Manager
{
    protected static $bdd;
    // table's names in db
    protected $categoryTable = 'category';
    protected $postTable = 'post';
    protected $commentTable = 'comment';
    protected $userTable = 'user';
    protected $newsletterTable = 'newsletter';


    // =============================== CONNEXION BDD ===============================

    protected function getBdd()
    {
        if (self::$bdd === null) {
            // Get parameters for db config
            $dsn = BddConfig::get("dsn");
            $login = BddConfig::get("login");
            $mdp = BddConfig::get("mdp");
            // create connexion to db
            self::$bdd = new PDO($dsn, $login, $mdp, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$bdd;
    }
}