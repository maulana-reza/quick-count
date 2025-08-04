<div class="grid gap-2 md:grid-cols-1">
    <div class="bg-white shadow rounded dark:bg-dark-eval-1 rounded-md overflow-hidden md:col-span-1">
        <div class="ml-2 flex-grow p-3">
            <div class="text-sm text-gray-500">
                Statistik Jumlah Pemilih Pemilu
            </div>
            <div>
                <span class="text-xs text-gray-500">Terakhir diperbarui: </span>
                <span id="update-time-value" class="text-xs font-semibold text-gray-700"></span>
            </div>
        </div>
        <div class="px-3 py-6 grid gap-2">
            <div id="chart-container" wire:ignore></div>
        </div>
    </div>
</div>
@section('plugins.Chartjs', true)
@section('js')
    <script type="module" defer>
        let chart;
        async function fetchChartData() {
            try {
            const response = await fetch('{{ asset('storage/chart.json') }}', { cache: 'no-store' });
                const data = await response.json();
                const updateTime = new Date(data.updated_at).toLocaleString('id-ID', {
                    dateStyle: 'medium',
                    timeStyle: 'medium',
                });
                document.getElementById('update-time-value').textContent = updateTime;
                if (!chart) {
                    chart = Highcharts.chart('chart-container', {
                        chart: { type: 'column' },
                        title: { text: '', align: 'left' },
                        xAxis: {
                            title: { text: 'Pasangan Calon' },
                            categories: data.categories },
                        yAxis: {
                            min: 0,
                            title: { text: 'Jumlah Pemilih' },
                            stackLabels: {
                                enabled: true,
                                formatter: function () {
                                    return this.total.toLocaleString();
                                },
                                style: { fontWeight: 'bold', fontSize: '20px' }
                            }
                        },
                        legend: {
                            enabled: true,
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal',
                            itemStyle: { fontSize: '10px' }
                        },
                        tooltip: {
                            shared: true,
                            useHTML: true,
                            formatter: function () {
                                let points = this.points;
                                let text = `<span style="font-size: 15px;">${points[0].key}</span><br/><br/>`;
                                let result = 0;
                                points.forEach(point => {
                                    result += point.y;
                                    text += `<div style="display: flex;"><div style="flex-grow: 1;"><span style="color:${point.color};">\u25CF</span> ${point.series.name.toUpperCase()}</div><b style="min-width: 30px;text-align: right">${point.y.toLocaleString()}</b></div><br/>`;
                                });
                                text += `<div style="display: flex;"><div style="flex-grow: 1;">TOTAL</div><b>${result.toLocaleString()}</b></div><br/>`;
                                return text;
                            }
                        },
                        plotOptions: {
                            column: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true,
                                    formatter: function () {
                                        return this.y;
                                    },
                                }
                            }
                        },
                        series: data.series
                    });
                } else {
                    chart.update({
                        xAxis: { categories: data.categories },
                        series: data.series
                    }, true, true);
                }
            } catch (err) {
                console.error("Gagal mengambil data chart:", err);
            }
        }
        // Ambil pertama kali
        fetchChartData();
        // Ambil ulang tiap 10 detik
        setInterval(fetchChartData, 10000);
    </script>
@endsection

