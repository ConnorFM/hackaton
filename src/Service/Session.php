<?php


namespace App\Service;

class Session
{

    static function createSession($id)
    {
        $_SESSION['userId'] = $id;
    }

    public function getUserId()
    {
        return $_SESSION['userId'];
    }
}
