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
    ];

    public function saksi()
    {
        return $this->belongsTo(Saksi::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
