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
        session_start();
        return $_SESSION['userId'];
    }
}
