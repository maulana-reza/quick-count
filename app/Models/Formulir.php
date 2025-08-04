<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;

class Formulir extends Model
{
    const BELUM_VALID = 'belum di validasi';
    const SUDAH_VALID = 'sudah valid';
    const TIDAK_VALID = 'tidak valid';
    const KEJADIAN_BELUM_DITANGANI = 'kejadian belum ditangani';
    const KEJADIAN_SUDAH_DITANGANI = 'kejadian sudah ditangani';
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
    protected static function booted()
    {
        static::created(function ($model) {
            if ($model->foto_kejadian) {
                $words = 'Formulir dengan di lokasi %s telah dibuat oleh %s, status formulir : %s, laporan kejadian : %s';
                $words .= ', dengan keterangan : %s';
                $lokasi = str_replace('/',' -> ',self::path($model->village_id));
                $words = sprintf($words, $lokasi, auth()->user()->name, $model->status_form, $model->laporan_kejadian, $model->foto_kejadian);
            }else{
                $lokasi = str_replace('/',' -> ',self::path($model->village_id));
                $words = 'Formulir dengan di lokasi %s telah ditambahkan oleh %s, status formulir : %s';
                $words = sprintf($words, $lokasi, auth()->user()->name, $model->status_form);

            }
            Log::create([
                'aksi' => 'Menambahkan formulir',
                'keterangan' => $words,
                'user_id' => auth()->id(),
            ]);
        });

        static::updated(function ($model) {
            if (auth()->user()->hasRole(User::KOORDINATOR_SAKSI)){
                $lokasi = str_replace('/',' -> ',self::path($model->village_id));
                $words = 'Formulir dilokasi %s telah diperbarui oleh %s, status formulir : %s, laporan kejadian : %s';
                $words .= ', dengan keterangan : %s';
                $words = sprintf($words, $model->id, auth()->user()->name, $model->status_form, $model->laporan_kejadian, $model->foto_kejadian);
            }else{
                $lokasi = str_replace('/',' -> ',self::path($model->village_id));
                $words = 'Formulir dengan dilokasi %s telah diperbarui oleh %s, status formulir : %s';
                $words = sprintf($words, $lokasi, auth()->user()->name, $model->status_form);
            }
            Log::create([
                'user_id' => auth()->id(),
                'aksi' => 'Memperbarui formulir',
                'keterangan' => $words,
            ]);
        });
    }

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
    public static function path($village_id) : string
    {
        $village = Village::findOrFail($village_id);
        return sprintf('%s/%s/%s',$village->city_name, $village->district_name, $village->name);
    }
}
