<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BingoCard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function numbers()
    {
        return $this->hasMany(BingoCardNumber::class, 'bingo_id', 'id');
    }

    /**
     * @return array|false
     */
    public function generateCard()
    {
        return [
            ['letter' => 'B', 'value' => $this->generateColumn('B'),],
            ['letter' => 'I', 'value' => $this->generateColumn('I'),],
            ['letter' => 'N', 'value' => $this->generateColumn('N'),],
            ['letter' => 'G', 'value' => $this->generateColumn('G'),],
            ['letter' => 'O', 'value' => $this->generateColumn('O'),],
        ];
    }

    public function generateColumn(string $letter)
    {
        $min = Game::RANGE_OF_NUMBERS[$letter][0];
        $max = Game::RANGE_OF_NUMBERS[$letter][1];

        $result = [];

        do {
            $result[] = random_int($min, $max);
            $result   = array_unique($result);
        } while (count($result) < 6);

        if ($letter === 'N') {
            $result = Arr::except($result, [2]);
        }

        return $result;
    }
}
