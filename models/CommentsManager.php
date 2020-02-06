<?php

class CommentsManager extends Manager {

    private $commentTable = 'comment';
    private $commentObject = 'Comment';
    
    // récupère tous les articles dans la bdd
    public function getComments($id) {
        return $this->getCommentsByPost($this->commentTable, 'post', $this->commentObject, $id);
    }

    // ajoute un article dans la bdd
    public function addComment($postId, $author, $comment) {
        return $this->insertComment($this->commentTable, $postId, $author, $comment);
    }

    public function reportOneComment($id) {
        return $this->reportComment($this->commentTable, $id);
    }
}