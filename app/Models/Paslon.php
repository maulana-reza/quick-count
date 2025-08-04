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
    public function getNameAttribute()
    {
        return 'No. Urut ' . $this->no_urut . ' - ' . $this->kepala . ' dan ' . $this->wakil;
    }
    public function getImageAssetAttribute()
    {
        return asset('storage/' . $this->foto_kepala);

    }
}
