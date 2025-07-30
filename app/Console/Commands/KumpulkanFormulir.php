<?php

namespace App\Console\Commands;

use App\Constants\Form;
use App\Models\DataFormulir;
use App\Models\FormUkt;
use App\Models\Paslon;
use App\Models\Periode;
use Illuminate\Console\Command;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

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
            'updated_at' => now()->toIso8601String(),
        ];

        $data = json_encode($data); // compact JSON
        $filePath = storage_path('app/public/chart.json');
        file_put_contents($filePath, $data);
        $this->line('Updating Periode...');

    }
    public function getDataCategories() : array
    {
        return Paslon::orderBy('no_urut')
            ->get()
            ->map(function ($paslon) {
                return 'No. Urut ' . $paslon->no_urut . ' - ' . $paslon->kepala . ' & ' . $paslon->wakil;
            })
            ->toArray();
    }

    private function getDataSeries()
    {
        $paslon = Paslon::orderBy('no_urut')
            ->get();
        $village = District::whereHas('city.province', function ($query) {
            $query->where('name', 'Papua');
        })->get();
        $series = [];
        $data = [];
        foreach ($paslon as $p) {
            foreach ($village as $item) {
                $data[$p->no_urut][$item->code] = DataFormulir::where('paslon_id', $p->id)
                    ->whereHas('formulir.village', function ($query) use ($item) {
                        $query->where('district_code', $item->code);
                    })
                    ->count();
            }
        }
        foreach ($village as $villageItem) {
            $series[] = [
                'name' => $villageItem->name . ' (' . $villageItem->code . ')',
                'data' => array_map(function ($paslonItem) use ($data, $villageItem) {
                    return $data[$paslonItem['no_urut']][$villageItem->code] ?? 0;
                }, $paslon->toArray()),
            ];
        }


        return $series;
    }

}
