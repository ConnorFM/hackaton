<?php


namespace App\Service;

class Session
{
    public function createSession($id)
    {
        session_start();
        $_Session['userId'] = $id;
    }

    public function getUserId()
    {
        session_start();
        return $_SESSION['userId'];
    }
}
