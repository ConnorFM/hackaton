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
    public function game6()
    {
        return $this->twig->render('Game/game6.html.twig', [
                                                            'random6Egg' => $this->get6RandomEgg(),
                                                            'randomEgg' => $this->getRandomEgg()

        ]);
    }

    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function game12()
    {
        return $this->twig->render('Game/game12.html.twig', [
                                                            'random12Egg' => $this->get12RandomEgg(),
                                                            'randomEgg' => $this->getRandomEgg(),
                                                            'score' => $this->getScore()

        ]);
    }

    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function game24()
    {
        return $this->twig->render('Game/game24.html.twig', [
                                                            'random24Egg' => $this->get24RandomEgg(),
                                                            'randomEgg' => $this->getRandomEgg()

        ]);
    }

    /**
     * Display 6 random eggs from the API
     *
     * @return array
     */
    public function get6RandomEgg()
    {
        $client = new \GuzzleHttp\Client([
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            ]);

        $array1 = [];
        $array2 = [];
        for ($i=0; $i<=5; $i++) {
            $response = $client->request('GET', 'eggs/random');
            $body = $response->getBody();
            $array1[] = json_decode($body->getContents(), true);
        }
        $array2 = $array1;
        shuffle($array1);
        $array = [$array1, $array2];
        return $array;
    }

    /**
     * Display 12 random eggs from the API
     *
     * @return array
     */
    public function get12RandomEgg()
    {
        $client = new \GuzzleHttp\Client([
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
        shuffle($array1);
        $array = [$array1, $array2];
        return $array;
    }

    /**
     * Display 24 random eggs from the API
     *
     * @return array
     */
    public function get24RandomEgg()
    {
        $client = new \GuzzleHttp\Client([
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            ]);

        $array1 = [];
        $array2 = [];
        for ($i=0; $i<=23; $i++) {
            $response = $client->request('GET', 'eggs/random');
            $body = $response->getBody();
            $array1[] = json_decode($body->getContents(), true);
        }
        $array2 = $array1;
        shuffle($array1);
        $array = [$array1, $array2];
        return $array;
    }

    /**
     * Display a random egg from the API
     *
     * @return array
     */
    public function getRandomEgg()
    {
        $client = new \GuzzleHttp\Client([
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
            ]);
        $response = $client->request('GET', 'eggs/random');
        $body = $response->getBody();
        $array1 = json_decode($body->getContents(), true);
        return $array1;
    }


    public function getScore()
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
    }

}
