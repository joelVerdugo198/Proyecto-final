<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    @if(Auth::user()->hasPermissionTo('view users'))

    <div id="dashboard-loan" style="padding-top: 20px"></div>

    <script  src="https://code.highcharts.com/highcharts.js"></script>
    <script >
        var datas = <?php echo json_encode($datasLoan) ?> 

        Highcharts.chart('dashboard-loan', {
            title: {
                text: "Loans of the current year"
            },
            subtitle: {
                text: "Loans of the current year"
            },
            xAxis: {
                categories: ['','January','February','March','April','May', 'June','July','August','September','October','November','December']
            },
            yAxis: {
                title: {
                    text: 'Number of loans'
                } 
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name:'Loan',
                data: datas
            }],
            responsive: {
                rules: [
                {
                    condition: {
                        maxwidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'right',
                        }
                    }
                }
            ]
            }


        })
    </script>

    @else
  
   <img src="/img/bienvenido.jpg"  style="width: 100%; height: 100%; background-repeat: no-repeat; background-position: center center;  background-attachment: fixed; background-size: cover; ">

    @endif
   
</x-app-layout>
