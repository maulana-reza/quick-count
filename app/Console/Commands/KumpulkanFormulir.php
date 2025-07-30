<?php

namespace App\Console\Commands;

use App\Constants\Form;
use App\Models\FormUkt;
use App\Models\Paslon;
use App\Models\Periode;
use Illuminate\Console\Command;

class KumpulkanFormulir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kumpulkan-formulir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'categories' => $this->getDataCategories(),
            'series' => $this->getDataSeries(),
        ];
    }
    public function getDataCategories() : array
    {
        return Paslon::orderBy('urutan')
            ->get()
            ->map(function ($paslon) {
                return 'No. Urut ' . $paslon->no_urut . ' - ' . $paslon->kepala . ' & ' . $paslon->wakil;
            })
            ->toArray();
    }

    private function getDataSeries()
    {

    }
    private function getDataSeriesByDate()
    {
        $period = Periode::oldest()->get()->pluck('id');
        $series = [];
        $sedang_mengisi = [];
        $finalisasi = [];
        foreach ($period as $datum) {
            $finalisasi[] = FormUkt::finalCountByPeriode($datum);
            $sedang_mengisi[] = FormUkt::onFillCountByPeriode($datum);
            $validasi[] = FormUkt::validCountByPeriode($datum);
            $perbaikan[] = FormUkt::fixCountByPeriode($datum);
            $ukt[] = FormUkt::uktCountByPeriode($datum);
        }
        $series[] = [
            'name' => ucwords(Form::FORM_NOT_FILL),
            'data' => $sedang_mengisi,
        ];
        $series[] = [
            'name' => ucwords(Form::FORM_FINALISASI),
            'data' => $finalisasi,
        ];
        $series[] = [
            'name' => ucwords(Form::FORM_VALID),
            'data' => $validasi,
        ];
        $series[] = [
            'name' => ucwords(Form::FORM_TOLAK),
            'data' => $perbaikan,
        ];
        $series[] = [
            'name' => ucwords(Form::FORM_UKT),
            'data' => $ukt,
        ];
        return $series;

    }

}
