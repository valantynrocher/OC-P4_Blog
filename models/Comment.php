<?php

class Comment {

    private $_id;
    private $_post_id;
    private $_author;
    private $_comment;
    private $_creation_date_fr;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    // hydratation des données
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // setters
    public function setId($id) {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setPostid($post_id) {
        $post_id = (int) $post_id;
        if ($post_id > 0) {
            $this->_post_id = $post_id;
        }
    }

    public function setAuthor($author) {
        if (is_string($author)){
            $this->_author = $author;
        }
    }

    public function setComment($comment) {
        if (is_string($comment)) {
            $this->_comment = $comment;
        }
    }

    public function setCreation_date_fr($creation_date_fr) {
        $this->_creation_date_fr = $creation_date_fr;
    }

    // getters
    public function id() {
        return $this->_id;
    }

    public function post_id() {
        return $this->_post_id;
    }

    public function author() {
        return $this->_author;
    }

    public function comment() {
        return $this->_comment;
    }

    public function creation_date_fr() {
        return $this->_creation_date_fr;
    }

}