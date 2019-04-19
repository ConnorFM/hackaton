<?php


namespace App\Model;

use PDO;

class CharacterManager extends AbstractManager
{
    const TABLE = 'character';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    // list characters
    public function listCharacters()
    {
        $character = $this->pdo->query("SELECT API_id FROM $this->table");
        return $character-> fetchAll(PDO::FETCH_ASSOC);
    }
}
