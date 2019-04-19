<?php


namespace App\Controller;

use App\Model\InventoryManager;
use App\Model\UserManager;
use App\Service\Session;
use GuzzleHttp\Client;

class InventController extends AbstractController
{
    protected $session;
    protected $inventoryManager;
    protected $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->inventoryManager = new InventoryManager();
        $this->userManager = new UserManager();
    }

    public function inventory()
    {

        $userEggs = $this->inventoryManager->listInventories($_SESSION['userId']);

        $api = new Client([
            'base_uri' => 'http://easteregg.wildcodeschool.fr/api/'
        ]);

        $eggsToShow = [];
        foreach ($userEggs as $userEgg) {
            $apiEggId = $userEgg['egg_Api'];
            $userEggId = $userEgg['id'];
            $response = $api->request('GET', "eggs/$apiEggId");
            $body = $response->getBody();
            $egg = json_decode($body->getContents(), true);
            $egg['price'] = $this->getPrice($egg['rarity']);
            $egg['userEggId'] = $userEggId;
            $eggsToShow[] = $egg;
        }
        return $this->twig->render(
            'Inventory/index.html.twig',
            ['eggs' => $eggsToShow]
        );
    }

    public function tradeToGold($rarity, $userEggId)
    {
        $gold = $this->getPrice($rarity);
        $actualGold = $this->userManager->getGold($_SESSION['userId']);
        $this->userManager->addGold(($gold + $actualGold), $_SESSION['userId']);
        $this->inventoryManager->deleteEggFromInventory($userEggId, $_SESSION['userId']);
        header('Location: /invent/inventory');
    }

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
