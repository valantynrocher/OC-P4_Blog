<?php

class CommentsManager extends Manager {
    
    // récupère tous les articles dans la bdd
    public function getComments($id) {
        return $this->getCommentsByPost('comment', 'post', 'Comment', $id);
    }

    // ajoute un article dans la bdd
    public function addComment($postId, $author, $comment) {
        return $this->insertComment('comment', $postId, $author, $comment);
    }
}