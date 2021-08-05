<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BingoCardNumber extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'check' => 'boolean',
    ];

    public function bingo()
    {
        return $this->hasOne(Bingo::class, 'id', 'bingo_id');
    }
}
