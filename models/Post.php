<?php

class Post {

    private $_id;
    private $_title;
    private $_category_id;
    private $_content;
    private $_creation_date_fr;
    private $_update_date_fr;
    private $_name;

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

    public function setTitle($title) {
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

    public function setCategoryId($category_id) {
        $category_id = (int) $category_id;
        if ($category_id > 0) {
            $this->_category_id = $category_id;
        }
    }

    public function setContent($content) {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

    public function setName($name) {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setCreation_date_fr($creation_date_fr) {
        $this->_creation_date_fr = $creation_date_fr;
    }

    public function setUpdate_date_fr($update_date_fr) {
        $this->_update_date_fr = $update_date_fr;
    }

    // getters
    public function id() {
        return $this->_id;
    }

    public function title() {
        return $this->_title;
    }

    public function category_id() {
        return $this->_category_id;
    }

    public function content() {
        return $this->_content;
    }

    public function creation_date_fr() {
        return $this->_creation_date_fr;
    }

    public function update_date_fr() {
        return $this->_update_date_fr;
    }

    public function name() {
        return $this->_name;
    }
}