<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameNumber extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
