<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    protected $table = 'paslon';

    protected $fillable = [
        'kepala',
        'wakil',
        'no_urut',
        'foto_kepala',
        'foto_wakil',
    ];
}
