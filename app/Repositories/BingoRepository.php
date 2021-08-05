<?php

namespace App\Repositories;

use App\Models\BingoCard;
use App\Models\BingoNumber;

class BingoRepository
{
    public function checkNumber(int $id, string $letter, int $value)
    {
        /**
         * @var BingoCard
         */
        $bingo = BingoCard::with('numbers')->find($id);

        /**
         * @var BingoNumber
         */
        $number = $bingo->numbers()->getQuery()->where('letter', $letter)->where('value', $value)->first();

        $number->check = true;
        $number->save();

        if ($bingo->numbers()->getQuery()->where('check', false)->count() === 0) {
            $bingo->winner = true;
            $bingo->save();
        }

        return $bingo->refresh();
    }

    public function winner($game_id, $bingo_id)
    {
        /**
         * @var BingoCard
         */
        $bingo = BingoCard::with('numbers')->where('game_id', $game_id)->where('id', $bingo_id)->first();

        if ($bingo->numbers->where('check', false)->count() === 0) {
            $bingo->winner = true;
            $bingo->save();
        }

        return $bingo->refresh();
    }
}
