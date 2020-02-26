<?php

class User
{
    // from user table
    private $user_id;
    private $user_first_name;
    private $user_last_name;
    private $user_login;
    private $user_password;
    private $user_email;
    private $user_role;
    private $user_last_connexion_fr;

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
    public function setUser_id($user_id)
    {
        $user_id = (int) $user_id;
        if ($user_id > 0) {
            $this->user_id = $user_id;
        }
    }

    public function setUser_first_name($user_first_name)
    {
        if (is_string($user_first_name)) {
            $this->user_first_name = $user_first_name;
        }
    }

    public function setUser_last_name($user_last_name)
    {
        if (is_string($user_last_name)) {
            $this->user_last_name = $user_last_name;
        }
    }

    public function setUser_login($user_login)
    {
        if (is_string($user_login)) {
            $this->user_login = $user_login;
        }
    }

    public function setUser_password($user_password)
    {
        if (is_string($user_password)) {
            $this->user_password = $user_password;
        }
    }

    public function setUser_email($user_email)
    {
        if (is_string($user_email)) {
            $this->user_email = $user_email;
        }
    }

    public function setUser_role($user_role)
    {
        if (is_string($user_role)) {
            if ($user_role === 'admin' || $user_role === 'reader') {
                $this->user_role = $user_role;
            }
        }
    }

    public function setUser_creation_date_fr($user_creation_date_fr)
    {
        $this->user_creation_date_fr = $user_creation_date_fr;
    }

    public function setUser_last_connexion_fr($user_last_connexion_fr)
    {
        $this->user_last_connexion_fr = $user_last_connexion_fr;
    }


    // getters
    public function userId()
    {
        return $this->user_id;
    }

    public function userFirstName()
    {
        return $this->user_first_name;
    }

    public function userLastName()
    {
        return $this->user_last_name;
    }

    public function userLogin()
    {
        return $this->user_login;
    }

    public function userPassword()
    {
        return $this->user_password;
    }

    public function userEmail()
    {
        return $this->user_email;
    }

    public function userRole()
    {
        return $this->user_role;
    }

    public function userCreationDateFr()
    {
        return $this->user_creation_date_fr;
    }

    public function userLastConnexionDateFr()
    {
        return $this->user_last_connexion_fr;
    }
}