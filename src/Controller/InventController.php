<?php


namespace App\Controller;

use GuzzleHttp\Client;
use App\Model\UserManager;

class InventController extends AbstractController
{

   /* public function inventory($user_id)
    {
        $userManager = new UserManager;
        $userEgg = $userManager->getinventory($user_id);

        $api = new Client([
            'base_uri' => 'http://easteregg.wildcodeschool.fr/api/'
        ]);

        $eggsToShow = [];
        for ($i = 0; $i < $userEgg; $i++) {
            $response = $api->request('GET', 'eggs/' .$userEgg['eggId']);
            $body = $response->getBody();
            $egg = json_decode($body->getContents());
            $egg[] = $this->getPrice($egg['rarity']);
            $eggsToShow[] = $egg;
        }
        return $this->twig->render('Inventory/index.html.twig', ['eggs' => $eggsToShow]);
    }*/


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
    }
}
