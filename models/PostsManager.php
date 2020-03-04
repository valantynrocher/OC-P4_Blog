<?php
namespace JeanForteroche\Models;

use JeanForteroche\Models\Manager;
use \PDO;

class PostsManager extends Manager
{
    private $postObject = 'JeanForteroche\Models\Post';

    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */
    
    protected function selectPublicPostsPagination($postTable, $categoryTable, $obj, $postPerPage, $offset)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $postTable.post_id, post_rank, post_title, $postTable.category_id, post_content,
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable
            ON $postTable.category_id = $categoryTable.category_id
            WHERE post_status = ?
            ORDER BY post_rank 
            DESC
            LIMIT $postPerPage
            OFFSET $offset"
        );
        $req->execute(array('public'));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectOnePublicPost($postTable, $categoryTable, $obj, $postId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $postTable.post_id, post_rank, post_title, $postTable.category_id, post_content, 
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            post_status,
            $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable
            ON $postTable.category_id = $categoryTable.category_id
            WHERE $postTable.post_id = ? AND post_status = 'public'"
        );
        $req->execute(array($postId));

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
        $req = self::$bdd->prepare(
            "SELECT $postTable.post_id, post_rank, post_title, $postTable.category_id, post_content, 
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr
            FROM $postTable 
            LEFT JOIN $categoryTable
            ON $postTable.category_id = $categoryTable.category_id 
            WHERE $categoryTable.category_id = ? AND post_status = ?
            ORDER BY post_rank
            DESC"
        );
        $req->execute(array(
            $categoryId,
            'public'
        ));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countPublicPostsNumber($postTable)
    {
        $this->getBdd();
        $req = self::$bdd->prepare("SELECT count(post_id) FROM $postTable WHERE post_status = ?");
        $req->execute(array('public'));
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    protected function selectAllPosts($postTable, $categoryTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $postTable.post_id, post_rank, post_title, $postTable.category_id, post_content,
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            post_status, $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable
            ON $postTable.category_id = $categoryTable.category_id
            ORDER BY post_rank
            DESC"
        );
        $req->execute(array('public'));
        

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
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
            "SELECT $postTable.post_id, post_rank, post_title, $postTable.category_id, post_content, 
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            post_status, $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable
            ON $postTable.category_id = $categoryTable.category_id
            WHERE $postTable.post_id = ?"
        );
        $req->execute(array($postId));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    protected function insertNewPost($postTable, $postRank, $postTitle, $categoryId, $postContent, $postStatus)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $postTable(post_rank, post_title, $postTable.category_id, post_content, post_creation_date, post_status) 
            VALUES(?, ?, ?, NOW(), ?)"
        );
        $affectedPost = $req->execute(array(
            $postRank,
            $postTitle,
            $categoryId,
            $postContent,
            $postStatus
        ));

        return $affectedPost;
        $req->closeCursor();
    }

    protected function updateChangedPost($postTable, $postId, $postRank, $postTitle, $categoryId, $postContent, $postStatus)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $postTable
            SET post_rank = :new_post_rank, post_title = :new_post_title, category_id = :new_category_id, post_content = :new_post_content, post_update_date = NOW(), post_status = :new_post_status
            WHERE post_id = :postId"
        );
        $affectedPost = $req->execute(array(
            'new_post_rank' => $postRank,
            'new_post_title' => $postTitle,
            'new_category_id' => $categoryId,
            'new_post_content' => $postContent,
            'new_post_status' => $postStatus,
            'postId' => $postId
        ));

        return $affectedPost;
    }

    protected function updateTrashedPost($postTable, $postId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $postTable
            SET post_status = 'trash'
            WHERE post_id = ?"
        );
        $affectedPost = $req->execute(array(
            $postId
        ));

        return $affectedPost;
    }

    protected function deletePostDeleted($postTable, $postId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $postTable
            WHERE post_id = ?"
        );
        $deletedPost = $req->execute(array(
            $postId
        ));

        return $deletedPost;
    }

    protected function selectLastFivePublicsPosts($postTable, $categoryTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT post_rank, post_title, $postTable.category_id,
            DATE_FORMAT(post_creation_date, 'le %d/%m/%Y à %Hh%i') AS post_creation_date_fr,
            DATE_FORMAT(post_update_date, 'le %d/%m/%Y à %Hh%i') AS post_update_date_fr,
            $categoryTable.category_title
            FROM $postTable
            LEFT JOIN $categoryTable 
            ON $postTable.category_id = $categoryTable.category_id
            WHERE post_status = ?
            ORDER BY post_rank
            DESC
            LIMIT 0, 5"
        );
        $req->execute(array('public'));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countProgressPostsNumber($postTable)
    {
        $this->getBdd();
        $req = self::$bdd->prepare("SELECT count(post_id) FROM $postTable WHERE post_status = ? ");
        $req->execute(array('progress'));
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    /* =================================================================================================================================
        REQUESTS GETTERS
    ================================================================================================================================= */

    // Requests for FRONT side

    public function getPublicPostsPagination($postPerPage, $offset)
    {
        return $this->selectPublicPostsPagination($this->postTable, $this->categoryTable, $this->postObject, $postPerPage, $offset);
    }

    public function getOnePublicPost($postId)
    {
        return $this->selectOnePublicPost($this->postTable, $this->categoryTable, $this->postObject, $postId);
    }

    public function getPublicPostsByCategory($categoryId)
    {
        return $this->selectPublicPostsByCategory($this->postTable, $this->categoryTable, $this->postObject, $categoryId);
    }

    public function getPublicPostsNumber()
    {
        return $this->countPublicPostsNumber($this->postTable);
    }

    // Requests for BACK side

    public function getAllPosts()
    {
        return $this->selectAllPosts($this->postTable, $this->categoryTable, $this->postObject);
    }

    public function getOnePost($postId)
    {
        return $this->selectOnePost($this->postTable, $this->categoryTable, $this->postObject, $postId);
    }

    public function setNewPost($postRank, $postTitle, $categoryId, $postContent, $postStatus)
    {
        return $this->insertNewPost($this->postTable, $postRank, $postTitle, $categoryId, $postContent, $postStatus);
    }

    public function setChangedPost($postId, $postRank, $postTitle, $categoryId, $postContent, $postStatus)
    {
        return $this->updateChangedPost($this->postTable, $postId, $postRank, $postTitle, $categoryId, $postContent, $postStatus);
    }

    public function setTrashedPost($postId)
    {
        return $this->updateTrashedPost($this->postTable, $postId);
    }

    public function setPostDeleted($postId)
    {
        return $this->deletePostDeleted($this->postTable, $postId);
    }

    public function getLastFivePublicsPosts()
    {
        return $this->selectLastFivePublicsPosts($this->postTable, $this->categoryTable, $this->postObject);
    }

    public function getProgressPostsNumber()
    {
        return $this->countProgressPostsNumber($this->postTable);
    }

}
