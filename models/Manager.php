<?php

abstract class Manager {

    private static $_bdd;

    // connexion à la bdd

    private static function setBdd() {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');

        // on utilise les constantes de PDO pour gérer les erreurs
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // fonction de connexion par défaut à la bdd
    protected function getBdd() {
        if (self::$_bdd == null) {
            self::setBdd();
            return self::setBdd();
        }
    }

    // CATEGORY

    // récupération de toutes les catégories
    protected function getAllCategories($table, $obj) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT id, name, image 
            FROM $table 
            ORDER BY id 
            ASC"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // récupération d'une catégories
    protected function getOneCategory($table, $obj, $catId) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->prepare(
            "SELECT name 
            FROM $table
            WHERE id=?"
        );
        $req->execute(array($catId));

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }


    // POST

    // récupération de tous les articles
    protected function getAllPosts($table1, $table2, $obj) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT $table1.id, title, category_id, content,
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr,
            $table2.name
            FROM $table1 
            LEFT JOIN $table2 
            ON $table1.category_id = $table2.id 
            ORDER BY $table1.id 
            DESC"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
    
    // récupération de tous les articles avec pagination
    protected function getAllPostsPages($table1, $table2, $obj, $postPerPage, $offset) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT $table1.id, title, category_id, content,
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr,
            $table2.name
            FROM $table1 
            LEFT JOIN $table2 
            ON $table1.category_id = $table2.id 
            ORDER BY $table1.id 
            DESC
            LIMIT $postPerPage
            OFFSET $offset"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // articles d'une catégorie
    protected function getPostsByCategory($table1, $table2, $obj, $catId) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT $table1.id, title, category_id, content, 
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr
            FROM $table1 
            LEFT JOIN $table2 
            ON $table1.category_id=$table2.id 
            WHERE $table2.id=$catId 
            ORDER BY $table1.id 
            DESC"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // récupération d'un seul article
    protected function getOnePost($table1, $table2, $obj, $id) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->prepare(
            "SELECT $table1.id, title, category_id, content, 
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr, $table2.name
            FROM $table1
            LEFT JOIN $table2 ON $table1.category_id=$table2.id
            WHERE $table1.id = ?"
        );
        $req->execute(array($id));

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données sous forme d'objets
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    // comptage des articles
    protected function countPost($table) {
        $this->getBdd();
        $req = self::$_bdd->query("SELECT count(id) FROM $table");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    // Mise à jour d'un article
    protected function updatePost($table, $id, $title, $categoryId, $content) {
        $this->getBdd();
        $req = self::$_bdd->prepare(
            "UPDATE $table
            SET title = :new_title, category_id = :new_catId, content = :new_content, update_date = NOW()
            WHERE id = $id"
        );
        $affectedPost = $req->execute(array(
            'new_title' => $title,
            'new_catId' => $categoryId,
            'new_content' => $content
        ));

        return $affectedPost;
    }

    // suppression d'un article
    protected function deletePost($table, $id) {
        $this->getBdd();
        $req = self::$_bdd->prepare(
            "DELETE FROM $table
            WHERE id = ?"
        );
        $deletedPost = $req->execute(array(
            $id
        ));
        var_dump($deletedPost);

        return $deletedPost;
    }

    // COMMENT

    // récupération des commentaires d'un article
    protected function getCommentsByPost($table1, $table2, $obj, $id) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT $table1.id, post_id, author, comment, report, 
            DATE_FORMAT($table1.creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr
            FROM $table1 LEFT JOIN $table2 
            ON $table1.post_id=$table2.id
            WHERE $table2.id=$id
            ORDER BY $table1.id DESC"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données sous forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // insertion d'un commentaire
    protected function insertComment($table, $postId, $author, $comment) {
        $this->getBdd();
        $req = self::$_bdd->prepare(
            "INSERT INTO $table(post_id, author, comment, creation_date) 
            VALUES(?, ?, ?, NOW() )"
        );
        $affectedComment = $req->execute(array(
            $postId,
            $author,
            $comment
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    // signalement d'un commentaire
    protected function reportComment($table, $id) {
        $this->getBdd();
        $req = self::$_bdd->prepare(
            "UPDATE $table
            SET report = 1
            WHERE id = ?"
        );
        $affectedComment = $req->execute(array(
            $id
        ));

        return $affectedComment;
        $req->closeCursor();
    }


    // USER

    // récupération de tous les utilisateurs
    protected function getAllUsers($table, $obj) {
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->query(
            "SELECT first_name, last_name, login, email, role 
            FROM $table 
            ORDER BY id 
            ASC"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // récupération des administrateurs
    protected function getAdminUsers($table, $obj) {
        $this->getBdd();
        $req = self::$_bdd->query(
            "SELECT first_name, last_name, login, password, email
            FROM $table
            WHERE role='admin'
            LIMIT 0, 1"
        );

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données osus forme d'objets
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // insertion d'un nouvel utilisateur
    protected function setNewUser($table, $firstName, $lastName, $login, $password, $email, $role) {
        $this->getBdd();
        $req = self::$_bdd->prepare(
            "INSERT INTO $table(first_name, last_name, login, password, email, role)
            VALUES (?, ?, ?, ?, ?, ?)");
        $affectedUser = $req->execute(array(
            $firstName,
            $lastName,
            $login,
            $password,
            $email,
            $role
        ));
        return $affectedUser;
        $req->closeCursor();
    }
}