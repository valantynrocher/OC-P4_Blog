<?php

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

    protected static function setBdd()
    {
        self::$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');

        // on utilise les constantes de PDO pour gérer les erreurs
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // fonction de connexion par défaut à la bdd
    protected function getBdd()
    {
        if (self::$bdd == null) {
            self::setBdd();
            return self::setBdd();
        }
    }

}