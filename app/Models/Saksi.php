<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    protected $table = 'saksi';
    protected $fillable = [
        'nik',
        'nama',
        'tps',
        'no_hp',
        'foto',
        'village_id',
        'user_id',
    ];

    public function laporanKejadian()
    {
        return $this->hasMany(LaporanKejadian::class);
    }

    public function formulir()
    {
        return $this->hasMany(Formulir::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
