<?php


namespace App\Service;

class Session
{
    public function createSession($id)
    {
        session_start();
        $_SESSION['userId'] = $id;
    }

    public function getUserId()
    {
        return $_SESSION['userId'];
    }
}
