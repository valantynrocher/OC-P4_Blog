<?php

class User
{

    private $id;
    private $first_name;
    private $last_name;
    private $login;
    private $password;
    private $email;
    private $role;

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

    public function setFirst_name($first_name)
    {
        if (is_string($first_name)) {
            $this->first_name = $first_name;
        }
    }

    public function setLast_name($last_name)
    {
        if (is_string($last_name)) {
            $this->last_name = $last_name;
        }
    }

    public function setLogin($login)
    {
        if (is_string($login)) {
            $this->login = $login;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    public function setEmail($email)
    {
        if (is_string($email)) {
            $this->email = $email;
        }
    }

    public function setRole($role)
    {
        if (is_string($role)) {
            $this->role = $role;
        }
    }


    // getters
    public function id()
    {
        return $this->id;
    }

    public function firstName()
    {
        return $this->first_name;
    }

    public function lastName()
    {
        return $this->last_name;
    }

    public function login()
    {
        return $this->login;
    }

    public function password()
    {
        return $this->password;
    }

    public function email()
    {
        return $this->email;
    }

    public function role()
    {
        return $this->role;
    }
}