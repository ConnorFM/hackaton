<?php
namespace App\Model;

use \PDO;

class UserManager extends AbstractManager
{
    // Enregistrement dans la BDD

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
        $insert = "INSERT INTO $this->table (username, password)
                   VALUES (:username, :password)";
        $statement = $this->pdo->prepare($insert);
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->bindValue('password', $password, \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    // recup scores / party / character

    public function listScoresPartyCharacter($user_id, $party_id, $character_id)
    {
        $scoreUser = $this->pdo->query("SELECT score FROM score WHERE user_id = "
                            .$user_id . " AND party_id = ".$party_id. "AND character_id = ".$character_id);
        
        $listScores = $scoreUser->fetchAll(PDO::FETCH_ASSOC);
        return $listScores;
    }

    // list inventories
    public function listInventories($userId): array
    {
        $statement = $this->pdo->prepare("SELECT 'egg_Api' FROM inventory WHERE 'user_id'= :user_id");
        $statement->bindValue('user_id', $userId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    // list characters
    public function listCharacters()
    {
        $charater = $this->pdo->query("SELECT API_id FROM character");
        $listCharacters = $charater-> fetchAll(PDO::FETCH_ASSOC);
        return $listCharacters;
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
}
