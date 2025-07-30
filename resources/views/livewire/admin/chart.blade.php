<div class="grid gap-2 md:grid-cols-5">
    <div class="bg-white shadow rounded dark:bg-dark-eval-1 rounded-md overflow-hidden md:col-span-2">
        <div class="ml-2 flex-grow p-3">
            <div class="text-sm text-gray-500">
                Statistik Jumlah Mahasiswa Per Periode
            </div>
        </div>
        <div class="px-3 py-6 grid gap-2">
            <div id="chart-container" wire:ignore></div>
        </div>
    </div>
</div>
@section('plugins.Chartjs', true)

@section('js')
    <script type="module">
        const chart = Highcharts.chart('chart-container', {
            chart: {
                type: 'column',
            },
            title: {
                text: '',
                align: 'left',
            },
            xAxis: {
                categories: @json($data['categories']),
                labels: {}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Mahasiswa'
                },
                stackLabels: {
                    enabled: true,
                    formatter: function () {
                        return this.total.toLocaleString();
                    },
                    style: {
                        fontWeight: 'bold',
                        fontSize: '20px',
                    }
                }
            },
            legend: {
                enabled: true,
                align: 'center',
                verticalAlign: 'bottom',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                y: 0,
                layout: 'horizontal',
                itemStyle: {
                    fontSize: '10px', // Sesuaikan ukuran teks jika diperlukan
                },
            },
            tooltip: {
                shared: true,
                useHTML: true, // Aktifkan HTML untuk tooltip
                style: {
                    lineHeight: 0.8,
                },
                formatter: function () {
                    let points = this.points;
                    let text = `<span style="font-size: 15px;">${points[0].key}</span><br/><br/>`;
                    let result = 0;
                    let y = "";
                    points.forEach(point => {
                        result += point.y;
                        y = point.y.toLocaleString();
                        text += `<div style="display: flex;"><div style="flex-grow: 1; "><span style="color:${point.color};">\u25CF</span> ${point.series.name.toUpperCase()} </div> <b style="min-width: 30px;text-align: right">${y}</b></div><br/>`;
                    });
                    let resultText = result.toLocaleString();
                    text += `<div style="display: flex;"><div style="flex-grow: 1; ">TOTAL </div> <b>${resultText}</b></div><br/>`;
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
                    },
                },
            },
            stackLabels: {
                enabled: true,
                formatter: function () {
                    return '' + Highcharts.numberFormat(this.total, 0)
                }
            },
            series: @json($data['series']),
        });
        const chartPembayaran = Highcharts.chart('chart-container-pembayaran', {
            chart: {
                type: 'column',
            },
            title: {
                text: '',
                align: 'left',
            },
            xAxis: {
                categories: @json($data['categories']),
                labels: {}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Pendapatan'
                },
                stackLabels: {
                    enabled: true,
                    formatter: function () {
                        return "Rp" + this.total.toLocaleString('ID');
                    },
                    style: {
                        fontWeight: 'bold',
                        fontSize: '20px',
                    }
                }
            },
            legend: {
                enabled: true,
                align: 'center',
                verticalAlign: 'bottom',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                y: 0,
                layout: 'horizontal',
                itemStyle: {
                    fontSize: '10px', // Sesuaikan ukuran teks jika diperlukan
                },
            },
            tooltip: {
                shared: true,
                useHTML: true, // Aktifkan HTML untuk tooltip
                style: {
                    lineHeight: 0.8,
                },
                formatter: function () {
                    let points = this.points;
                    let text = `<span style="font-size: 15px;">${points[0].key}</span><br/><br/>`;
                    let result = 0;
                    let y = "";
                    points.forEach(point => {
                        result += point.y;
                        y = "Rp"+point.y.toLocaleString('ID');
                        text += `<div style="display: flex;"><div style="flex-grow: 1; "><span style="color:${point.color};">\u25CF</span> ${point.series.name.toUpperCase()} </div> <b style="min-width: 30px;text-align: right">${y}</b></div><br/>`;
                    });
                    let resultText = "Rp"+result.toLocaleString('ID');
                    text += `<div style="display: flex;"><div style="flex-grow: 1; ">TOTAL </div> <b>${resultText}</b></div><br/>`;
                    return text;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return "Rp" + this.y.toLocaleString('ID');
                        },
                    },
                },
            },
            stackLabels: {
                enabled: true,
                formatter: function () {
                    return '' + Highcharts.numberFormat(this.total, 0)
                }
            },
            series: @json($data['series_pembayaran']),
        });
        Livewire.on('chartUpdated', (data) => {
            data[0].series.forEach((data, index) => {
                chart.series[index].update(data);
            }, chart);
            chart.xAxis[0].setCategories(data[0].categories);
        });
    </script>
@endsection

