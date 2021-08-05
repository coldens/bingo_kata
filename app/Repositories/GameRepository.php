<?php

use App\Models\BingoCard;
use App\Models\Game;
use Illuminate\Support\Collection;

class GameRepository {
    public function start() {
        $game = new Game();
        $game->save();

        return $game;
    }

    public function show($id)
    {
        return Game::find($id);
    }

    public function generateNumber($id)
    {
        /**
         * @var Game
         */
        $game = Game::find($id);
        $result = $game->numberGenerator();

        if ($result === false) {
            return false;
        }

        $game->numbers()->create([
            'letter' => $result['letter'],
            'value'  => $result['value'],
        ]);

        return $result;
    }

    public function generateBingo($id)
    {
        $bingo = new BingoCard();
        $bingo->game_id = $id;
        $bingo->save();

        $letters = $bingo->generateCard();

        $card = new Collection();

        foreach ($letters as $letter) {
            foreach ($letter['value'] as $value) {
                $card->push(['letter' => $letter, 'value' => $value]);
            }
        }

        $bingo->numbers()->createMany($card);

        return $bingo->load('numbers');
    }
}
