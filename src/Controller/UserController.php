<?php
namespace App\Controller;

use App\Model\UserManager;

class UserController extends \App\Controller\AbstractController
{

    public function signin()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->verify($_POST['username'], $_POST['password']);

            if (empty($error)) {
                $objetUser = new UserManager('users');
                $objetUser->addUser($_POST['username'], $_POST['password']);
                return $this->twig->render('Admin/signin.html.twig', ['success'=>'Account saved with success']);
            }
            else {
                return $this->twig->render('Admin/signin.html.twig', ['error'=>$error]);
            }
        }
        else{
            return $this->twig->render('Admin/signin.html.twig');
        }
    }


    public function signup()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->verify($_POST['username'], $_POST['password']);

            if (empty($error)) {
                $objetUser = new UserManager('users');

                if($_POST['password'] == $_POST['password_conf'])
                {

                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $objetUser->addUser($_POST['username'], $_POST['password']);
                    return $this->twig->render('Admin/signup.html.twig', ['success' => 'Account saved with success']);
                }
                else {
                    return $this->twig->render('Admin/signup.html.twig', ['error'=>$error]);
                }

            }
            else {
                return $this->twig->render('Admin/signup.html.twig', ['error'=>$error]);
            }
        }
        else{
            return $this->twig->render('Admin/signup.html.twig');
        }
    }



    /*vérification des champs d'inscription*/


    private function verify($username, $password)
    {
        $error = [];

        /*username = vérification champs vide et correctement rempli*/
        if (empty($username)) {
            $error['username'] = "Username name is required";
        }

        if (!preg_match("/^[a-z A-Z]*$/", $username)) {
            $error['username'] = "Only letters are allowed";
        }



        if (empty($password)) {
            $error['password'] = 'A password is required';
        }
        if (strlen($password) < 8) {
            $error['password'] = 'At least 8 characters are required';
        }

        if ($_POST['password'] != $_POST['password_conf']) {
            $error['password'] = 'Both passwords are not matching';
        }
        return $error;
    }
}
