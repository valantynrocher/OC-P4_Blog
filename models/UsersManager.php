<?php

class UsersManager extends Manager
{
    private $userObject = 'User';


    /* =================================================================================================================================
        REQUESTS SETTERS
    ================================================================================================================================= */
    
    protected function selectAllUsers($userTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT user_first_name, user_last_name, user_login, user_email, user_role 
            FROM $userTable 
            ORDER BY user_id 
            ASC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectAdminUsers($userTable, $obj)
    // temporary select only one for dev time
    {
        $this->getBdd();
        $req = self::$bdd->query(
            "SELECT user_first_name, user_last_name, user_login, user_password, user_email
            FROM $userTable
            WHERE user_role = 'admin'
            LIMIT 0, 1"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function insertNewUser($userTable, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "INSERT INTO $userTable(user_first_name, user_last_name, user_login, user_password, user_email, user_role)
            VALUES (?, ?, ?, ?, ?, ?)");
        $affectedUser = $req->execute(array(
            $userFirstName,
            $userLastName,
            $userLogin,
            $userPassword,
            $userEmail,
            $userRole
        ));
        return $affectedUser;
        $req->closeCursor();
    }

    /* =================================================================================================================================
        REQUESTS GETTERS
    ================================================================================================================================= */
    
    public function getAllUsers()
    {
        return $this->selectAllUsers($this->userTable, $this->userObject);
    }
    
    public function getAdminUsers()
    {
        return $this->selectAdminUsers($this->userTable, $this->userObject);
    }

    public function setNewUser($userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        return $this->insertNewUser($this->userTable, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole);
    }
}