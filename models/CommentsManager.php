<?php

class CommentsManager extends Manager
{

    private $commentTable = 'comment';
    private $commentObject = 'Comment';
    
    // récupère tous les articles dans la bdd
    public function getComments($id)
    {
        return $this->getCommentsByPost($this->commentTable, 'post', $this->commentObject, $id);
    }

    // ajoute un article dans la bdd
    public function addComment($postId, $author, $comment)
    {
        return $this->insertComment($this->commentTable, $postId, $author, $comment);
    }

    // signale un commentaire
    public function reportOneComment($id)
    {
        return $this->reportComment($this->commentTable, $id);
    }

    // récupération des commentaires signalés et à modérer
    public function listReportComments()
    {
        return $this->getReportComments($this->commentTable, 'post', $this->commentObject);
    }

    // récupération des commentaires valides et/ou modérés
    public function listModerateComments()
    {
        return $this->getModerateComments($this->commentTable, 'post', $this->commentObject);
    }

    // modération d'un commentaire qui a été signalé
    public function  moderateOneComment($id)
    {
        return $this->setModerateComment($this->commentTable, $id);
    }

    // suppression d'un commentaire
    public function deleteOneComment($id)
    {
        return $this->deleteComment($this->commentTable, $id);
    }
}