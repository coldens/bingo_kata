<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;

class GameController extends Controller
{
    private $gameRepository;

    public function __construct()
    {
        $this->gameRepository = new GameRepository();
    }

    /**
     * Start a new game
     */
    public function start()
    {
        return $this->gameRepository->start();
    }

    /**
     * Return a current game
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return $this->gameRepository->show($id);
    }

    /**
     * Get a random number for the game
     */
    public function getNumber($id)
    {
        $result = $this->gameRepository->generateNumber($id);

        if ($result === false) {
            return [
                'message' => 'the game is finished.',
            ];
        }

        return $result;
    }

    public function generateBingo($id)
    {
        return $this->gameRepository->generateBingo($id);
    }

    public function getBingoCard($id, $bingo_id)
    {
        return $this->gameRepository->getBingoCard($id, $bingo_id);
    }
}
