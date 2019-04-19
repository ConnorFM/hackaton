<?php


namespace App\Controller;

use App\Model\InventoryManager;
use App\Service\Session;
use GuzzleHttp\Client;

class InventController extends AbstractController
{
    protected $session;
    protected $inventoryManager;

    public function __construct()
    {
        parent::__construct();
        $this->session = new Session();
        $this->inventoryManager = new InventoryManager();
    }

    public function inventory()
    {

        $userEggs = $this->inventoryManager->listInventories($this->session->getUserId());

        $api = new Client([
            'base_uri' => 'http://easteregg.wildcodeschool.fr/api/'
        ]);

        $eggsToShow = [];
        foreach ($userEggs as $userEgg) {
            $response = $api->request('GET', "eggs/$userEgg");
            $body = $response->getBody();
            $egg = json_decode($body->getContents(), true);
            $egg['price'] = $this->getPrice($egg['rarity']);
            $egg['userEggId'] = $userEgg['id'];
            $eggsToShow[] = $egg;
        }
        return $this->twig->render('Inventory/index.html.twig', ['eggs' => $eggsToShow]);
    }

    /*public function tradeToGold($rarity, $eggId)
    {
        $gold = $this->getPrice($rarity);
        $this->userManager->addGold($gold, $this->session->getUserId());
        $this->userManager->deleteEggFromInventory($eggId, $this->session->getUserId());
        header('Location: /invent/inventory');
    }*/

    public function addToInventory($apiEggId)
    {
        $this->inventoryManager->addAnEggToInventory($apiEggId, $this->session->getUserId());
    }

    private function getPrice($rarity)
    {
        $price = "";
        switch ($rarity) {
            case 'junk':
                $price = 1;
                break;
            case 'basic':
                $price = 2;
                break;
            case 'fine':
                $price = 5;
                break;
            case 'masterwork':
                $price = 10;
                break;
            case 'rare':
                $price = 15;
                break;
            case 'exotic':
                $price = 20;
                break;
            case 'ascended':
                $price = 30;
                break;
            case 'legendary':
                $price = 50;
                break;
        }
        return $price;
    }
}
