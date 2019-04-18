<?php


namespace App\Controller;

use App\Service\Session;
use GuzzleHttp\Client;
use App\Model\UserManager;

class InventController extends AbstractController
{
    /*protected $session;
    protected $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->session = new Session();
        $this->userManager = new UserManager();
    }

    public function inventory()
    {

        $userEgg = $this->userManager->listInventories($this->session->getUserId());

        $api = new Client([
            'base_uri' => 'http://easteregg.wildcodeschool.fr/api/'
        ]);

        $eggsToShow = [];
        for ($i = 0; $i < $userEgg; $i++) {
            $response = $api->request('GET', 'eggs/' . $userEgg['egg_Api']);
            $body = $response->getBody();
            $egg = json_decode($body->getContents(), 1);
            $egg[] = $this->getPrice($egg['rarity']);
            $egg[] = ['userEggId' => $userEgg[$i]['id']];
            $eggsToShow[] = $egg;
        }
        return $this->twig->render('Inventory/index.html.twig', ['eggs' => $eggsToShow]);
    }

    public function tradeToGold($rarity, $eggId)
    {
        $gold = $this->getPrice($rarity);
        $this->userManager->addGold($gold, $this->session->getUserId());
        $this->userManager->deleteEggFromInventory($eggId, $this->session->getUserId());
        header('Location: /invent/inventory');
    }

    public function addToInventory($apiEggId)
    {
        $this->userManager->addAnEggToInventory($apiEggId, $this->session->getUserId());
    }

    private function getPrice($rarity)
    {
        $price = [];
        switch ($rarity) {
            case 'junk':
                $price[] = ['price' => 1];
                break;
            case 'basic':
                $price[] = ['price' => 2];
                break;
            case 'fine':
                $price[] = ['price' => 5];
                break;
            case 'masterwork':
                $price[] = ['price' => 10];
                break;
            case 'rare':
                $price[] = ['price' => 15];
                break;
            case 'exotic':
                $price[] = ['price' => 20];
                break;
            case 'ascended':
                $price[] = ['price' => 30];
                break;
            case 'legendary':
                $price[] = ['price' => 50];
                break;
        }
        return $price;
    }*/
}
