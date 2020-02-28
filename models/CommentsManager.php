<?php

class CommentsManager extends Manager
{

    private $commentObject = 'Comment';

    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */

    //***************** Rq front side *****************/

    protected function selectCommentsByPost($commentTable, $obj, $postId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT comment_id, $commentTable.post_id, comment_author, comment_content, 
            DATE_FORMAT(comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, comment_start_id,
                (SELECT comment_id FROM $commentTable WHERE comment_start_id = comment_id) AS comment_answer_id,
                (SELECT comment_content FROM $commentTable WHERE comment_start_id = comment_id) AS comment_answer_content
            FROM $commentTable
            WHERE $commentTable.post_id = ? AND comment_start_id = 0
            ORDER BY comment_id
            DESC"
        );
        $req->execute(array(
            $postId
        ));

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
            SET comment_status = 'report'
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
            comment_status, comment_start_id, $postTable.post_title
            FROM $commentTable 
            LEFT JOIN $postTable 
            ON $commentTable.comment_id = $postTable.post_id
            WHERE comment_status = 'report' AND comment_start_id = 0
            ORDER BY $commentTable.comment_id 
            DESC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectWaitingComments($commentTable, $postTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT $commentTable.comment_id, $commentTable.post_id, comment_author, comment_content,
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, comment_start_id, $postTable.post_title
            FROM $commentTable 
            LEFT JOIN $postTable 
            ON $commentTable.comment_id = $postTable.post_id
            WHERE comment_status = 'waiting' AND comment_start_id = 0
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
            comment_status, comment_start_id, $postTable.post_title
            FROM $commentTable 
            LEFT JOIN $postTable 
            ON $commentTable.comment_id = $postTable.post_id
            WHERE comment_status = 'public' AND comment_start_id = 0
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
            SET comment_status = 'public'
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

    protected function selectLastFivePublicsComments($commentTable, $postTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT comment_author,
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            $postTable.post_title
            FROM $commentTable LEFT JOIN $postTable 
            ON $commentTable.post_id = $postTable.post_id
            WHERE comment_status = 'public'
            ORDER BY $commentTable.comment_id
            DESC
            LIMIT 0, 5"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countReportCommentsNumber($commentTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(comment_id) FROM $commentTable WHERE comment_status = 'report'");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    protected function countWaitingCommentsNumber($commentTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(comment_id) FROM $commentTable WHERE comment_status = 'waiting'");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    protected function selectOneComment($commentTable, $postTable, $commentId, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT $commentTable.comment_id, $commentTable.post_id, comment_author, comment_content, 
            DATE_FORMAT($commentTable.comment_creation_date, 'le %d/%m/%Y à %Hh%i') AS comment_creation_date_fr,
            comment_status, comment_start_id, $postTable.post_title,
            (SELECT comment_id FROM $commentTable WHERE comment_start_id = $commentTable.comment_id) AS comment_answer_id,
            (SELECT comment_content FROM $commentTable WHERE comment_start_id = $commentTable.comment_id) AS comment_answer_content
            FROM $commentTable
            LEFT JOIN $postTable 
            ON $commentTable.post_id = $postTable.post_id
            WHERE $commentTable.comment_id = $commentId"
        );
        $req->execute(array($commentId));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    protected function insertCommentAnswer($commentTable, $postId, $commentAuthor, $commentContent, $commentStartId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $commentTable(post_id, comment_author, comment_content, comment_creation_date, comment_status, comment_start_id) 
            VALUES(?, ?, ?, NOW(), 'public', ?)"
        );
        $affectedComment = $req->execute(array(
            $postId,
            $commentAuthor,
            $commentContent,
            $commentStartId
        ));

        return $affectedComment;
        $req->closeCursor();
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

    public function getWaitingComments()
    {
        return $this->selectWaitingComments($this->commentTable, $this->postTable, $this->commentObject);
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

    public function getLastFivePublicsComments()
    {
        return $this->selectLastFivePublicsComments($this->commentTable, $this->postTable, $this->commentObject);
    }

    public function getReportCommentsNumber()
    {
        return $this->countReportCommentsNumber($this->commentTable);
    }

    public function getWaitingCommentsNumber()
    {
        return $this->countWaitingCommentsNumber($this->commentTable);
    }

    public function getOneComment($commentId)
    {
        return $this->selectOneComment($this->commentTable, $this->postTable, $commentId, $this->commentObject);
    }

    public function setCommentAnswer($postId, $commentAuthor, $commentContent, $commentStartId)
    {
        return$this->insertCommentAnswer($this->commentTable, $postId, $commentAuthor, $commentContent, $commentStartId);
    }
}