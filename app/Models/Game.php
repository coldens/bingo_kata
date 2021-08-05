<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    const RANGE_OF_NUMBERS = [
        'B' => [1, 15],
        'I' => [16, 30],
        'N' => [31, 45],
        'G' => [46, 60],
        'O' => [61, 75],
    ];

    public function numbers()
    {
        return $this->hasMany(GameNumber::class, 'game_id', 'id');
    }

    /**
     * @return array|false
     */
    public function numberGenerator(array $exclude = [])
    {
        /**
         * finished
         */
        if (count($exclude) === 5) {
            return false;
        }

        /**
         * Get a random of valid letter but exclude from $exclude array
         */
        $letter  = array_rand(array_keys(Arr::except(Game::RANGE_OF_NUMBERS, $exclude)), 1);
        $current = $this->numbers()->getQuery()->where('letter', $letter)->get();

        /**
         * add the letter to the exclude list
         */
        array_push($exclude, $letter);

        /**
         * The letter isn't available, generate for another letter.
         */
        if ($current->count() === 15) {
            return $this->numberGenerator(array_merge($exclude, [$letter]));
        }

        do {
            $number = $this->randomByLetter($letter);
        } while ($current->first(function (GameNumber $item) use ($number) {
            return $item->value === $number;
        }) != null);

        return [$letter, $number];
    }

    public function randomByLetter(string $letter)
    {
        $range = Game::RANGE_OF_NUMBERS[$letter];

        return random_int($range[0], $range[1]);
    }
}
