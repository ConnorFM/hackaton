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

    // recup scores / party / character

    public function listScoresPartyCharacter($user_id, $party_id, $character_id)
    {
        $scoreUser = $this->pdo->query("SELECT score FROM score WHERE user_id = "
                            .$user_id . " AND party_id = ".$party_id. "AND character_id = ".$character_id);
        
        $listScores = $scoreUser->fetchAll(PDO::FETCH_ASSOC);
        return $selScores;
    }

    // list inventories
    public function listInventories($user_id)
    {
        $inventory = $this->pdo->query("SELECT id, egg_id FROM inventory WHERE user_id = "
                            .$user_id);
        $listInventories = $inventory-> fetchAll(PDO::FETCH_ASSOC);
        return $listInventories;
    }

    // list characters
    public function listCharacters()
    {
        $charater = $this->pdo->query("SELECT API_id FROM character WHERE user_id = ".$user_id);
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
}
