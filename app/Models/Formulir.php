<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;

class Formulir extends Model
{
    protected $table = 'formulir';

    protected $fillable = [
        'saksi_id',
        'village_id',
        'no_formulir',
        'foto',
        'status_form',
        'laporan_kejadian',
        'foto_kejadian',
        'status_kejadian',
        'tps_id',
    ];

    public function saksi()
    {
        return $this->belongsTo(Saksi::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}
