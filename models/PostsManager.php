<?php

class PostsManager extends Manager
{
    private $postObject = 'Post';

    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */

    // Requests for BOTH sides

    protected function selectAllPosts($postTable, $categoryTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $postTable.post_id, post_title, $postTable.category_id, post_content,
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            $categoryTable.category_title
            FROM $postTable 
            LEFT JOIN $categoryTable 
            ON $postTable.category_id = $categoryTable.category_id
            ORDER BY $postTable.post_id 
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

    protected function selectOnePost($postTable, $categoryTable, $obj, $postId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $postTable.post_id, post_title, $postTable.category_id, post_content, 
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            post_status,
            $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable ON $postTable.category_id = $categoryTable.category_id
            WHERE $postTable.post_id = ?"
        );
        $req->execute(array($postId));

        // créé la variable data qui contiendra les données
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            // var contiendra les données sous forme d'objets
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    // Requests for FRONT side (ONLY PUBLIC POSTS (WHERE post_status = 2))
    
    protected function selectPublicPostsPagination($postTable, $categoryTable, $obj, $postPerPage, $offset)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $postTable.post_id, post_title, $postTable.category_id, post_content,
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable 
            ON $postTable.category_id = $categoryTable.category_id
            WHERE post_status = 2
            ORDER BY $postTable.post_id 
            DESC
            LIMIT $postPerPage
            OFFSET $offset"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectPublicPostsByCategory($postTable, $categoryTable, $obj, $categoryId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $postTable.post_id, post_title, $postTable.category_id, post_content, 
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr
            FROM $postTable 
            LEFT JOIN $categoryTable 
            ON $postTable.category_id = $categoryTable.category_id 
            WHERE $categoryTable.category_id=$categoryId AND post_status = 2
            ORDER BY $postTable.post_id 
            DESC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countPublicPostsNumber($table)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(post_id) FROM $table WHERE post_status = 2");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    // Requests for BACK side

    protected function insertNewPost($table, $postTitle, $categoryId, $postContent)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $table(post_title, $postTable.category_id, post_content, post_creation_date) 
            VALUES(?, ?, ?, NOW())"
        );
        $affectedPost = $req->execute(array(
            $postTitle,
            $categoryId,
            $postContent
        ));

        return $affectedPost;
        $req->closeCursor();
    }

    protected function updateChangedPost($table, $postId, $postTitle, $categoryId, $postContent)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $table
            SET post_title = :new_post_title, $postTable.category_id = :new_category_id, post_content = :new_post_content, post_update_date = NOW()
            WHERE post_id = $postId"
        );
        $affectedPost = $req->execute(array(
            'new_post_title' => $postTitle,
            'new_category_id' => $categoryId,
            'new_post_content' => $postContent
        ));

        return $affectedPost;
    }

    protected function deletePostDeleted($table, $postId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $table
            WHERE post_id = ?"
        );
        $deletedPost = $req->execute(array(
            $postId
        ));

        return $deletedPost;
    }

    /* =================================================================================================================================
        REQUESTS GETTERS
    ================================================================================================================================= */

    public function getAllPosts()
    {
        return $this->selectAllPosts($this->postTable, $this->categoryTable, $this->postObject);
    }

    public function getOnePost($postId)
    {
        return $this->selectOnePost($this->postTable, $this->categoryTable, $this->postObject, $postId);
    }

    public function getPublicPostsPagination($postPerPage, $offset)
    {
        return $this->selectPublicPostsPagination($this->postTable, $this->categoryTable, $this->postObject, $postPerPage, $offset);
    }

    public function getPublicPostsByCategory($categoryId)
    {
        return $this->selectPublicPostsByCategory($this->postTable, $this->categoryTable, $this->postObject, $categoryId);
    }

    public function getPublicPostsNumber()
    {
        return $this->countPublicPostsNumber($this->postTable);
    }

    public function setNewPost($postTitle, $categoryId, $postContent)
    {
        return $this->insertNewPost($this->postTable, $postTitle, $categoryId, $postContent);
    }

    public function setChangedPost($postId, $postTitle, $categoryId, $postContent)
    {
        return $this->updateChangedPost($this->postTable, $postId, $postTitle, $categoryId, $postContent);
    }

    public function setPostDeleted($postId)
    {
        return $this->deletePostDeleted($this->postTable, $postId);
    }

}
