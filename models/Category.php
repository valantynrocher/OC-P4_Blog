<?php

class Category {

    private $_id;
    private $_name;
    private $_image;

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

    public function setName($name) {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setImage($image) {
        if (is_string($image)) {
            $this->_image = $image;
        }
    }

    // getters
    public function id() {
        return $this->_id;
    }

    public function name() {
        return $this->_name;
    }

    public function image() {
        return $this->_image;
    }
}