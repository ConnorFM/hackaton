<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\GameManager;
use GuzzleHttp\Client;

/**
 * Class GameManager
 *
 */
class GameController extends AbstractController
{
    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item['title'] = $_POST['title'];
            $itemManager->update($item);
        }

        if(isset($_POST[$this->get9RandomEgg(['id'])]))
        {
            $_SESSION[$this->get9RandomEgg(['id'])] = $_POST[$this->get9RandomEgg(['id'])];
            header('Location:index.php');
        }*/
        return $this->twig->render('Game/game12.html.twig', [
                                                            'random12Egg' => $this->get9RandomEgg(),
                                                            'randomEgg' => $this->getRandomEgg()
                                                            //'score' => $this->getScore()
        ]);
    }

    /**
     * Display 12 random eggs from the API
     *
     * @return array
     */
    public function get9RandomEgg()
    {
        $client = new Client([
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            ]);

        $array1 = [];
        $array2 = [];
        for ($i=0; $i<=8; $i++) {
            $response = $client->request('GET', 'eggs/random');
            $body = $response->getBody();
            $array1[] = json_decode($body->getContents(), true);
        }
        $array2 = $array1;
        $array = array_merge($array1, $array2);
        shuffle($array);
        return $array;
    }

    /**
     * Display a random egg from the API
     *
     * @return array
     */
    public function getRandomEgg()
    {
        $client = new Client([
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            ]);
        $response = $client->request('GET', 'eggs/random');
        $body = $response->getBody();
        $array1 = json_decode($body->getContents(), true);
        return $array1;
    }

    /*public function getScore()
    {
        $score = 0;
        if ($id1 === $id2){
            $score += 10000;
        } elseif ($rarity1 === 'junk' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score -= 100;
        } elseif ($rarity1 === 'basic' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 1;
        } elseif ($rarity1 === 'fine' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 50;
        } elseif ($rarity1 === 'masterwork' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 100;
        } elseif ($rarity1 === 'rare' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 200;
        } elseif ($rarity1 === 'exotic' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 300;
        } elseif ($rarity1 === 'ascended' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 400;
        } elseif ($rarity1 === 'legendary' && $rarity1 === $rarity2 && $id1 != $id2) {
            $score += 600;
        }

        return $score;
    }*/
}
