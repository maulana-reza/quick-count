<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;

class Tps extends Model
{
    protected $table = 'tps';

    protected $fillable = [
        'alamat',
        'no_tps',
        'village_id',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
