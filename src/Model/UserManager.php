<?php
namespace App\Model;

use \PDO;

class UserManager extends AbstractManager
{
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addUser($username, $password)
    {
        $insert = "INSERT INTO $this->table (username, password, gold)
                   VALUES (:username, :password, :gold)";
        $statement = $this->pdo->prepare($insert);
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->bindValue('password', $password, \PDO::PARAM_STR);
        $statement->bindValue('gold', 0, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    // list characters/user
    public function listCharactersUser($user_id)
    {
        $charater = $this->pdo->query("SELECT API_id FROM userCharacter
                                    INNER JOIN character ON character.id = userCharacter.id
                                    WHERE user_id = ".$user_id);
        $listCharacters = $charater-> fetchAll(PDO::FETCH_ASSOC);
        return $listCharacters;
    }

    public function isUserExist($username)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE `username` = :username");
        $statement->bindValue('username', $username, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function getGold($id)
    {
        $statement = $this->pdo->prepare("SELECT `gold` FROM $this->table WHERE `id` = :user_id");
        $statement->bindValue('user_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addGold($gold, $userId)
    {
        $statement = $this->pdo->prepare("UPDATE $this->table
                                                    SET gold = gold + $gold
                                                    WHERE `id` = :userId");
        $statement->bindValue('userId', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}
