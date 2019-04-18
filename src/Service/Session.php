<?php


namespace App\Service;

class Session
{

    public function createSession($id)
    {
        $_SESSION['userId'] = $id;
    }

    public function getUserId()
    {
        return $_SESSION['userId'];
    }
}
