<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataFormulir extends Model
{
    protected $table = 'data_formulir';

    protected $fillable = [
        'formulir_id',
        'paslon_id',
        'value',
    ];

    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }

    public function paslon()
    {
        return $this->belongsTo(Paslon::class);
    }
}
