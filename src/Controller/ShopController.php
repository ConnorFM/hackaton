<?php


namespace App\Controller;

use App\Model\UserManager;
use App\Service\Session;

class ShopController extends AbstractController
{

/*public function index($charactId, $price)
{
    $characterManager = new CharacterManager;
    $charactList = $characterManager->listOfUnlockCharacter($this->session->getUserId());

    $userManager = new UserManager();
    $gold = $userManager->getGold($this->session->getUserId());

    if (!in_array($charactId, $charactList) and $gold >= $price) {
        $characterManager->addUnlockCharacter($charactId, $this->session->getUserId());
        $userManager->decreaseGold($price);
        header('Location: index.php');
    } else {
        return $this->twig->render('');
    }*/
}
