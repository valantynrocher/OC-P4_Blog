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
            "SELECT user_first_name, user_last_name, user_login, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable 
            ORDER BY user_creation_date_fr 
            ASC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectAdminUsers($userTable, $obj)
    {
        $this->getBdd();
        $req = self::$bdd->query(
            "SELECT user_id, user_first_name, user_last_name, user_login, user_password, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable
            WHERE user_role = 'admin'
            ORDER BY user_creation_date_fr 
            ASC"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function selectReaderUsers($userTable, $obj)
    {
        $this->getBdd();
        $req = self::$bdd->query(
            "SELECT user_id, user_first_name, user_last_name, user_login, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable
            WHERE user_role = 'reader'
            ORDER BY user_creation_date_fr 
            ASC"
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
            "INSERT INTO $userTable(user_first_name, user_last_name, user_login, user_password, user_email, user_role, user_creation_date)
            VALUES (?, ?, ?, ?, ?, ?, NOW())");
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

    protected function selectOneUser($userTable, $obj, $userId)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT user_id, user_first_name, user_last_name, user_login, user_password, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable
            WHERE user_id = ?"
        );
        $req->execute(array(
            $userId
        ));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    protected function updateChangedUser($userTable, $userId, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $userTable
            SET user_first_name = :new_user_first_name, user_last_name = :new_user_last_name,
            user_login = :new_user_login, user_password = :new_user_password,
            user_email = :new_user_email, user_role = :new_user_role
            WHERE user_id = $userId"
        );
        $affectedUser = $req->execute(array(
            'new_user_first_name' => $userFirstName,
            'new_user_last_name' => $userLastName,
            'new_user_login' => $userLogin,
            'new_user_password' => $userPassword,
            'new_user_email' => $userEmail,
            'new_user_role' => $userRole
        ));

        return $affectedUser;
    }

    protected function deleteUserDeleted($userTable, $userId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "DELETE FROM $userTable
            WHERE user_id = ?"
        );
        $deletedUser = $req->execute(array(
            $userId
        ));

        return $deletedUser;
    }

    protected function selectLastFiveUsers($userTable, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->query(
            "SELECT user_login, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable 
            ORDER BY user_creation_date_fr 
            DESC
            LIMIT 0, 5"
        );

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function countAdminUsersNumber($userTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(user_id) FROM $userTable WHERE user_role = 'admin'");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    protected function countReaderUsersNumber($userTable)
    {
        $this->getBdd();
        $req = self::$bdd->query("SELECT count(user_id) FROM $userTable WHERE user_role = 'reader'");
        $count = (int)$req->fetch(PDO::FETCH_NUM)[0];

        return $count;
        $req->closeCursor();
    }

    // get a count to check if user already register for login or for adding new user
    protected function selectUserRegisterNumber($userTable, $userLogin)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "SELECT *
            FROM $userTable
            WHERE user_login = ?"
        );
        $result = $req->execute(array(
            $userLogin
        ));

        $count = (int)$req->fetch(PDO::FETCH_NUM);

        return $count;
        $req->closeCursor();
    }

    protected function selectAuthUser($userTable, $userLogin, $obj)
    {
        $this->getBdd();
        $var = [];
        $req = self::$bdd->prepare(
            "SELECT user_id, user_first_name, user_last_name, user_login, user_password, user_email, user_role,
            DATE_FORMAT(user_creation_date, '%d/%m/%Y') AS user_creation_date_fr,
            DATE_FORMAT(user_last_connexion, 'le %d/%m/%Y à %Hh%i') AS user_last_connexion_fr
            FROM $userTable
            WHERE user_login = ?"
        );
        $req->execute(array(
            $userLogin
        ));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }

        return $var;
        $req->closeCursor();
    }

    protected function updateLastConnexionUser($userTable, $userId)
    {
        $this->getBdd();
        $req = self::$bdd->prepare(
            "UPDATE $userTable
            SET user_last_connexion = NOW()
            WHERE user_id = $userId"
        );
        $affectedUser = $req->execute();

        return $affectedUser;
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

    public function getReaderUsers()
    {
        return $this->selectReaderUsers($this->userTable, $this->userObject);
    }

    public function setNewUser($userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        return $this->insertNewUser($this->userTable, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole);
    }

    public function getOneUser($userId)
    {
        return $this->selectOneUser($this->userTable, $this->userObject, $userId);
    }

    public function setChangedUser($userId, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole)
    {
        return $this->updateChangedUser($this->userTable, $userId, $userFirstName, $userLastName, $userLogin, $userPassword, $userEmail, $userRole);
    }

    public function setUserDeleted($userId)
    {
        return $this->deleteUserDeleted($this->userTable, $userId);
    }

    public function getLastFiveUsers()
    {
        return $this->selectLastFiveUsers($this->userTable, $this->userObject);
    }

    public function getAdminUsersNumber()
    {
        return $this->countAdminUsersNumber($this->userTable);
    }

    public function getReaderUsersNumber()
    {
        return $this->countReaderUsersNumber($this->userTable);
    }

    public function getUserRegisterNumber($userLogin)
    {
        return $this->selectUserRegisterNumber($this->userTable, $userLogin);
    }

    public function getAuthUser($userLogin)
    {
        return $this->selectAuthUser($this->userTable, $userLogin, $this->userObject);
    }

    public function setLastConnexionUser($userId)
    {
        return $this->updateLastConnexionUser($this->userTable, $userId);
    }
}