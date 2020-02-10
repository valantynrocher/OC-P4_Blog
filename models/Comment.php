<?php

class Comment
{

    private $id;
    private $post_id;
    private $author;
    private $comment;
    private $creation_date_fr;
    private $report;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // hydratation des données
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // setters
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function setPostid($post_id)
    {
        $post_id = (int) $post_id;
        if ($post_id > 0) {
            $this->post_id = $post_id;
        }
    }

    public function setAuthor($author)
    {
        if (is_string($author)){
            $this->author = $author;
        }
    }

    public function setComment($comment)
    {
        if (is_string($comment)) {
            $this->comment = $comment;
        }
    }

    public function setCreation_date_fr($creation_date_fr)
    {
        $this->creation_date_fr = $creation_date_fr;
    }

    public function setReport($report)
    {
        $report = (int) $report;
        if ($report === 0 || $report === 1) {
            $this->report = $report;
        }
    }

    // getters
    public function id()
    {
        return $this->id;
    }

    public function postId()
    {
        return $this->post_id;
    }

    public function author()
    {
        return $this->author;
    }

    public function comment()
    {
        return $this->comment;
    }

    public function creationDateFr()
    {
        return $this->creation_date_fr;
    }

    public function report()
    {
        return $this->report;
    }
}