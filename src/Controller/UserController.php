<?php
namespace App\Controller;

use App\Model\UserManager;
use App\Service\Session;

class UserController extends AbstractController
{

    public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->verifylogin($_POST['username'], $_POST['password']);

            if (empty($error)) {
                $objectUser = new UserManager();
                $user = $objectUser->isUserExist($_POST['username']);
                if ($user['password'] == $_POST['password']) {
                        $session = new Session();
                        $session->createSession($user['id']);
                        return $this->twig->render(
<<<<<<< HEAD
                            'Home/index.html.twig', ['success' => 'You are connected', 'session'=>$session->getUserId()]);
=======
                            'Home/index.html.twig',
                            ['success' => 'You are connected']
                        );
>>>>>>> dev
                } else {
                    $errors['password'] = 'Your passwords are not the same';
                    return $this->twig->render('Admin/signin.html.twig', ['error' => $errors]);
                }
            }
        } else {
            return $this->twig->render('Admin/signin.html.twig');
        }
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->verify($_POST['username'], $_POST['password'], $_POST['password_conf']);

            if (empty($error)) {
                $objetUser = new UserManager();
                $user = $objetUser->addUser($_POST['username'], $_POST['password']);
                $session = new Session();
                $session->createSession($user['id']);

                return $this->twig->render('Home/index.html.twig', ['success' => 'Account saved with success']);
            } else {
                return $this->twig->render('Admin/signup.html.twig', ['error' => $error]);
            }
        } else {
            return $this->twig->render('Admin/signup.html.twig');
        }
    }




    /*vérification des champs d'inscription*/


    private function verify($username, $password, $passwordConf)
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

        if ($password != $passwordConf) {
            $error['password'] = 'Both passwords are not matching';
        }
        return $error;
    }

    private function verifylogin($username, $password)
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
        return $error;
    }
}
