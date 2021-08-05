<?php

namespace App\Http\Controllers;

use App\Repositories\BingoRepository;
use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private $gameRepository;
    private $bingoRepository;

    public function __construct()
    {
        $this->gameRepository = new GameRepository();
        $this->bingoRepository = new BingoRepository();
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

    /**
     * Generate a new bingo card.
     */
    public function generateBingo($id)
    {
        return $this->gameRepository->generateBingo($id);
    }

    /**
     * For check the bingo card.
     */
    public function getBingoCard($id, $bingo_id)
    {
        return $this->gameRepository->getBingoCard($id, $bingo_id);
    }

    /**
     * for update the bingo card
     */
    public function checkNumber(Request $request)
    {
        $bingo_id = $request->get('bingo_id');
        $letter = $request->get('letter');
        $value = $request->get('value');

        return $this->bingoRepository->checkNumber($bingo_id, $letter, $value);
    }

    /**
     * for set the winner.
     */
    public function winner($game_id, $bingo_id)
    {
        return $this->bingoRepository->winner($game_id, $bingo_id);
    }
}
