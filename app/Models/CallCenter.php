<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallCenter extends Model
{
    protected $table = 'call_center';

    protected $fillable = [
        'nama',
        'no_hp',
    ];
}
