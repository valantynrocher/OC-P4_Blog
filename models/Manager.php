<?php

abstract class Manager
{

    private static $bdd;

    // =============================== CONNEXION BDD ===============================

    private static function setBdd()
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

    // =============================== CATEGORY ===============================

    // récupération de toutes les catégories
    protected function getAllCategories($table, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT id, chapter, image 
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
    protected function getOneCategory($table, $obj, $catId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT id, chapter, image
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

    // comptage des catégories
    protected function countCategories($table)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(id) FROM $table");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    // Insertion d'une nouvelle catégorie
    protected function insertCategory($table, $chapter, $image)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $table(chapter, image) 
            VALUES(?, ?)"
        );
        $affectedCategory = $req->execute(array(
            $chapter,
            $image
        ));

        return $affectedCategory;
        $req->closeCursor();
    }

    protected function updateCategory($table, $id, $chapter, $image)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $table
            SET chapter = :new_chapter, image = :new_image
            WHERE id = $id"
        );
        $affectedPost = $req->execute(array(
            'new_chapter' => $chapter,
            'new_image' => $image
        ));

        return $affectedCategory;
    }

    protected function deleteCategory($table, $id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $table
            WHERE id = ?"
        );
        $deletedCategory = $req->execute(array(
            $id
        ));

        return $deletedCategory;
    }


    // =============================== POST ===============================

    //***************** Rq both sides *****************/

    // récupération de tous les articles
    protected function getAllPosts($table1, $table2, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $table1.id, title, category_id, content,
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr,
            $table2.chapter
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

    // récupération d'un seul article
    protected function getOnePost($table1, $table2, $obj, $id)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $table1.id, title, category_id, content, 
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr, $table2.chapter
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

    //***************** Rq front side *****************/
    
    // récupération de tous les articles avec pagination
    protected function getAllPostsPages($table1, $table2, $obj, $postPerPage, $offset)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $table1.id, title, category_id, content,
            DATE_FORMAT(creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            DATE_FORMAT(update_date, 'le %d/%m/%Y à %Hh%i') AS update_date_fr,
            $table2.chapter
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
    protected function getPostsByCategory($table1, $table2, $obj, $catId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
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

    // comptage des articles
    protected function countPosts($table)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(id) FROM $table");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    // comptage des articles par catégorie
    protected function countPostsByCategory($table, $category_id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare("SELECT count(id) FROM $table WHERE category_id = ?");
        $count = (int)$req->execute(array(
            $category_id
        ));

        return $count;
        $req->closeCursor();
    }

    //***************** Rq back side *****************/

    // Insertion d'un nouvel article
    protected function insertPost($table, $title, $categoryId, $content)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $table(title, category_id, content, creation_date) 
            VALUES(?, ?, ?, NOW())"
        );
        $affectedPost = $req->execute(array(
            $title,
            $categoryId,
            $content
        ));

        return $affectedPost;
        $req->closeCursor();
    }

    // Mise à jour d'un article
    protected function updatePost($table, $id, $title, $categoryId, $content)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
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
    protected function deletePost($table, $id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $table
            WHERE id = ?"
        );
        $deletedPost = $req->execute(array(
            $id
        ));

        return $deletedPost;
    }

    // =============================== COMMENT ===============================

    //***************** Rq front side *****************/

    // récupération des commentaires d'un article
    protected function getCommentsByPost($table1, $table2, $obj, $id)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
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
    protected function insertComment($table, $postId, $author, $comment)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
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
    protected function reportComment($table, $id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $table
            SET report = 1, moderate = 0
            WHERE id = ?"
        );
        $affectedComment = $req->execute(array(
            $id
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    //***************** Rq back side *****************/

    // récupération des commentaires signalés et à modérer
    protected function getReportComments($table1, $table2, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $table1.id, post_id, author, comment,
            DATE_FORMAT($table1.creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            $table2.title
            FROM $table1 
            LEFT JOIN $table2 
            ON $table1.post_id = $table2.id
            WHERE report = 1 AND moderate = 0
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

    // récupération de tous les commentaires non signalés ou validés
    protected function getModerateComments($table1, $table2, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $table1.id, post_id, author, comment,
            DATE_FORMAT($table1.creation_date, 'le %d/%m/%Y à %Hh%i') AS creation_date_fr,
            $table2.title
            FROM $table1 
            LEFT JOIN $table2 
            ON $table1.post_id = $table2.id
            WHERE report = 0 AND moderate = 1
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

    // modération d'un commentaire
    protected function setModerateComment($table, $id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $table
            SET report = 0, moderate = 1
            WHERE id = ?"
        );
        $affectedComment = $req->execute(array(
            $id
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    // suppression d'un commentaire
    protected function deleteComment($table, $id)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $table
            WHERE id = ?"
        );
        $affectedComment = $req->execute(array(
            $id
        ));

        return $affectedComment;
    }

    // =============================== USER (only back side) ===============================

    // récupération de tous les utilisateurs
    protected function getAllUsers($table, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
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
    protected function getAdminUsers($table, $obj)
    {
        $this->getBdd();
        $req = self::$bdd->query(
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
    protected function setNewUser($table, $firstName, $lastName, $login, $password, $email, $role)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
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

    // =============================== NEWSLETTER ===============================

    // insertion d'un nouvel abonné
    protected function setEmail($table, $email)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $table(email, suscribe_date)
            VALUES (?, NOW()");
        $affectedLine = $req->execute(array(
            $email
        ));
        return $affectedLine;
        $req->closeCursor();
    }

}