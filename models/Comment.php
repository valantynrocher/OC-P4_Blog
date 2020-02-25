<?php

class Comment
{
    // from comment table
    private $comment_id;
    private $post_id;
    private $comment_author;
    private $comment_content;
    private $comment_creation_date_fr;
    private $comment_status;
    private $comment_start_id;
    private $comment_answer_id;
    private $comment_answer_content;
    // from post table
    private $post_title;

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
    public function setComment_id($comment_id)
    {
        $comment_id = (int) $comment_id;
        if ($comment_id > 0) {
            $this->comment_id = $comment_id;
        }
    }

    public function setPost_id($post_id)
    {
        $post_id = (int) $post_id;
        if ($post_id > 0) {
            $this->post_id = $post_id;
        }
    }

    public function setComment_author($comment_author)
    {
        if (is_string($comment_author)){
            $this->comment_author = $comment_author;
        }
    }

    public function setComment_content($comment_content)
    {
        if (is_string($comment_content)) {
            $this->comment_content = $comment_content;
        }
    }

    public function setComment_creation_date_fr($comment_creation_date_fr)
    {
        $this->comment_creation_date_fr = $comment_creation_date_fr;
    }

    public function setComment_status($comment_status) {
        if (is_string($comment_status)) {
            if ($comment_status === 'report' || $comment_status === 'waiting' || $comment_status === 'public')
            $this->comment_status = $comment_status;
        }
    }

    public function setComment_start_id($comment_start_id)
    {
        $comment_start_id = (int) $comment_start_id;
        if ($comment_start_id >= 0) {
            $this->comment_start_id = $comment_start_id;
        }
    }

    public function setComment_answer_id($comment_answer_id)
    {
        $comment_answer_id = (int) $comment_answer_id;
        if ($comment_answer_id > 0) {
            $this->comment_answer_id = $comment_answer_id;
        }
    }

    public function setComment_answer_content($comment_answer_content)
    {
        if (is_string($comment_answer_content)) {
            $this->comment_answer_content = $comment_answer_content;
        }
    }

    public function setPost_title($post_title)
    {
        if (is_string($post_title)){
            $this->post_title = $post_title;
        }
    }

    // getters
    public function commentId()
    {
        return $this->comment_id;
    }

    public function post_id()
    {
        return $this->post_id;
    }

    public function commentAuthor()
    {
        return $this->comment_author;
    }

    public function commentContent()
    {
        return $this->comment_content;
    }

    public function commentCreationDateFr()
    {
        return $this->comment_creation_date_fr;
    }

    public function commentStatus()
    {
        return $this->comment_status;
    }

    public function commentStartId()
    {
        return $this->comment_start_id;
    }

    public function commentAnswerId()
    {
        return $this->comment_answer_id;
    }

    public function commentAnswerContent()
    {
        return $this->comment_answer_content;
    }

    public function postTitle()
    {
        return $this->post_title;
    }
}