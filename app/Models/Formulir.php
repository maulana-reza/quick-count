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
        'suara_tidak_sah',
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

    public function data_formulir()
    {
        return $this->hasMany(Formulir::class, 'tps_id', 'id');
    }

    public static function countByDistrict($district_code)
    {
        $formulirs = self::whereHas('village', function ($query) use ($district_code) {
            $query->where('district_code', $district_code);
        })->get();

        $suara_sah = $formulirs->flatMap(function ($formulir) {
            return $formulir->data_formulir;
        })->sum('value');

        $suara_tidak_sah = $formulirs->sum('suara_tidak_sah');

        return [
            'suara_sah' => $suara_sah,
            'suara_tidak_sah' => $suara_tidak_sah,
        ];
    }

    public static function countByVillage($village_code)
    {
        $formulirs = self::whereHas('village', function ($query) use ($village_code) {
            $query->where('code', $village_code);
        })->get();

        $suara_sah = $formulirs->flatMap(function ($formulir) {
            return $formulir->data_formulir;
        })->sum('value');

        $suara_tidak_sah = $formulirs->sum('suara_tidak_sah');

        return [
            'suara_sah' => $suara_sah,
            'suara_tidak_sah' => $suara_tidak_sah,
        ];
    }

    public static function countByCities($cities_code)
    {
        $formulirs = self::whereHas('village.district.city', function ($query) use ($cities_code) {
            $query->where('code', $cities_code);
        })->get();

        $suara_sah = $formulirs->flatMap(function ($formulir) {
            return $formulir->data_formulir;
        })->sum('value');

        $suara_tidak_sah = $formulirs->sum('suara_tidak_sah');

        return [
            'suara_sah' => $suara_sah,
            'suara_tidak_sah' => $suara_tidak_sah,
        ];
    }
    public static function countByProvince($province_code)
    {
        $formulirs = self::whereHas('village.district.city.province', function ($query) use ($province_code) {
            $query->where('code', $province_code);
        })->get();

        $suara_sah = $formulirs->flatMap(function ($formulir) {
            return $formulir->data_formulir;
        })->sum('value');

        $suara_tidak_sah = $formulirs->sum('suara_tidak_sah');

        return [
            'suara_sah' => $suara_sah,
            'suara_tidak_sah' => $suara_tidak_sah,
        ];

    }
}
