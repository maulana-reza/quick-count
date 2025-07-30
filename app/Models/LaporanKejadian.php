<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKejadian extends Model
{
    protected $table = 'laporan_kejadian';

    protected $fillable = [
        'saksi_id',
        'kejadian',
        'foto',
    ];

    public function saksi()
    {
        return $this->belongsTo(Saksi::class);
    }
}
