<?php
namespace App\Model;

class UserManager extends \App\Model\AbstractManager
{
    // Enregistrement dans la BDD

    public function addUser($username, $password)
    {
        $insert = 'INSERT INTO users (username, password)
        VALUES (:username, :password)';

        $prep = $this->pdo->prepare($insert);

        $prep->bindValue('username', $username, \PDO::PARAM_STR);
        $prep->bindValue('password', $password, \PDO::PARAM_STR);

        $prep->execute();
    }
}
