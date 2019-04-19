<?php


namespace App\Model;

use PDO;

class ScoreManager extends AbstractManager
{
    // recup scores / party / character

    public function listScoresPartyCharacter($user_id, $party_id, $character_id)
    {
        $scoreUser = $this->pdo->query("SELECT score FROM score WHERE user_id = "
            .$user_id . " AND party_id = ".$party_id. "AND character_id = ".$character_id);
        $listScores = $scoreUser->fetchAll(PDO::FETCH_ASSOC);
        return $listScores;
    }
}
