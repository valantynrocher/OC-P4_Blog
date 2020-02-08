<?php

class User {

    private $_id;
    private $_first_name;
    private $_last_name;
    private $_login;
    private $_password;
    private $_email;
    private $_role;

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

    public function setFirst_name($first_name) {
        if (is_string($first_name)) {
            $this->_first_name = $first_name;
        }
    }

    public function setLast_name($last_name) {
        if (is_string($last_name)) {
            $this->_last_name = $last_name;
        }
    }

    public function setLogin($login) {
        if (is_string($login)) {
            $this->_login = $login;
        }
    }

    public function setPassword($password) {
        if (is_string($password)) {
            $this->_password = $password;
        }
    }

    public function setEmail($email) {
        if (is_string($email)) {
            $this->_email = $email;
        }
    }

    public function setRole($role) {
        if (is_string($role)) {
            $this->_role = $role;
        }
    }


    // getters
    public function id() {
        return $this->_id;
    }

    public function first_name() {
        return $this->_first_name;
    }

    public function last_name() {
        return $this->_last_name;
    }

    public function login() {
        return $this->_login;
    }

    public function password() {
        return $this->_password;
    }

    public function email() {
        return $this->_email;
    }

    public function role() {
        return $this->_role;
    }
}