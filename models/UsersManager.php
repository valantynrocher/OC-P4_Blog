<?php

class UsersManager extends Manager
{
    
    // récupère tous les administrateurs
    public function getAdmins()
    {
        return $this->getAdminUsers('user', 'User');
    }

    // récupère tous les utilisateurs
    public function allUsers()
    {
        return $this->getAllUsers('user', 'User');
    }

    // créé un nouvel utilisateur
    public function addUser($firstName, $lastName, $login, $password, $email, $role)
    {
        return $this->setNewUser('user', $firstName, $lastName, $login, $password, $email, $role);
    }
}