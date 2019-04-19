<?php


namespace App\Model;

use PDO;

class InventoryManager extends AbstractManager
{

    const TABLE = 'inventory';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    // list inventories
    public function listInventories($userId): array
    {
        $statement = $this->pdo->prepare("SELECT egg_Api, id FROM $this->table WHERE user_id = :user_id");
        $statement->bindValue('user_id', $userId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAnEggToInventory($egg_Api, $id)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`egg_Api`, `user_id`) VALUES (:egg_Api, :user_id)");
        $statement->bindValue('egg_Api', $egg_Api, \PDO::PARAM_STR);
        $statement->bindValue('user_id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteEggFromInventory($UserEggId, $userId)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table 
                                                    WHERE `user_id` = :UserEggId
                                                    AND `id` = :userId");
        $statement->bindValue('UserEggId', $UserEggId, \PDO::PARAM_INT);
        $statement->bindValue('userId', $userId, \PDO::PARAM_INT);
        $statement->execute();
    }
}
