<?php

class CommentsManager extends Manager
{

    private $commentObject = 'Comment';

    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */

    //***************** Rq front side *****************/

    protected function selectCommentsByPost($commentTable, $postTable, $obj, $postId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $commentTable.comment_id, $commentTable.post_id, comment_author, comment_content, 
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, $postTable.post_title
            FROM $commentTable LEFT JOIN $postTable 
            ON $commentTable.post_id = $postTable.post_id
            WHERE $commentTable.post_id = $postId
            ORDER BY $commentTable.comment_id
            DESC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function insertNewComment($commentTable, $postId, $commentAuthor, $commentContent)
    // By default, new comments are in "waiting" status
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $commentTable(post_id, comment_author, comment_content, comment_creation_date) 
            VALUES(?, ?, ?, NOW() )"
        );
        $affectedComment = $req->execute(array(
            $postId,
            $commentAuthor,
            $commentContent
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    protected function updateToReportComment($commentTable, $commentId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $commentTable
            SET comment_status=1
            WHERE comment_id = ?"
        );
        $affectedComment = $req->execute(array(
            $commentId
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    //***************** Rq back side *****************/

    protected function selectReportedComments($commentTable, $postTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $commentTable.comment_id, $commentTable.post_id, comment_author, comment_content,
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, $postTable.post_title
            FROM $commentTable 
            LEFT JOIN $postTable 
            ON $commentTable.comment_id = $postTable.post_id
            WHERE comment_status = 'report'
            ORDER BY $commentTable.comment_id 
            DESC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectModeratedComments($commentTable, $postTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $commentTable.comment_id, $commentTable.post_id, comment_author, comment_content,
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, $postTable.post_title
            FROM $commentTable 
            LEFT JOIN $postTable 
            ON $commentTable.comment_id = $postTable.post_id
            WHERE comment_status = 'public'
            ORDER BY $commentTable.comment_id 
            DESC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function updateToModerateComment($commentTable, $commentId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $commentTable
            SET comment_status = 3
            WHERE comment_id = ?"
        );
        $affectedComment = $req->execute(array(
            $commentId
        ));

        return $affectedComment;
        $req->closeCursor();
    }

    protected function deleteCommentDeleted($commentTable, $commentId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $commentTable
            WHERE id = ?"
        );
        $deletedComment = $req->execute(array(
            $commentId
        ));

        return $deletedComment;
    }

    /* =================================================================================================================================
        REQUESTS GETTERS
    ================================================================================================================================= */
    
    public function getCommentsByPost($postId)
    {
        return $this->selectCommentsByPost($this->commentTable, $this->postTable, $this->commentObject, $postId);
    }

    public function setNewComment($postId, $commentAuthor, $commentContent)
    {
        return $this->insertNewComment($this->commentTable, $postId, $commentAuthor, $commentContent);
    }

    public function setReportComment($commentId)
    {
        return $this->updateToReportComment($this->commentTable, $commentId);
    }

    public function getReportedComments()
    {
        return $this->selectReportedComments($this->commentTable, $this->postTable, $this->commentObject);
    }

    public function getModeratedComments()
    {
        return $this->selectModeratedComments($this->commentTable, $this->postTable, $this->commentObject);
    }

    public function setModerateComment($commentId)
    {
        return $this->updateToModerateComment($this->commentTable, $commentId);
    }

    public function setCommentDeleted($commentId)
    {
        return $this->deleteCommentDeleted($this->commentTable, $commentId);
    }
}