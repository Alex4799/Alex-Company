@extends('admin.layout.index')
@section('title')
    Dashboard
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @foreach ($sale as $item)
                <input type="hidden" value="{{$item->total}}" class="total">
                <input type="hidden" value="{{$item->date}}" class="date">
            @endforeach

            @foreach ($products as $item)
            <input type="hidden" value="{{$item->product_name}}" class="product_name">
            <input type="hidden" value="{{$item->product_qty}}" class="product_qty">
            @endforeach

            <div class="col-lg-10 offset-lg-1">

                <div class="row">
                    <h4 class="col-lg-5">Product Dashboard by Order</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productOrderPlan')))
                                Daily
                            @elseif (request('productOrderPlan')=='month')
                                Monthly
                            @elseif (request('productOrderPlan')=='year')
                                Yearly
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#saleDashboard')}}">Daily</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#saleDashboard',['productOrderPlan'=> 'month'])}}">Monthly</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#saleDashboard',['productOrderPlan'=> 'year'])}}">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div id="chart-order-day"></div>

                <div class="row">
                    <h4 class="col-lg-5">Product Trend</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productTrendPlan')))
                                All
                            @else
                                {{request('productTrendPlan')}}
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#saleDashboard')}}">All</a></li>
                          @foreach ($productsOrderDate as $item)
                            <li><a class="dropdown-item" href="{{route('admin#saleDashboard',['productTrendPlan'=> $item->date])}}">{{$item->date}}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div id="chart-products-qty"></div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.2/apexcharts.min.js" integrity="sha512-yWglrpRYz/pD0pp1cSpWmSVvcFwuuc739X4WHy7hRKB11BGijnz7fuqKRQB7Ksot42IN365OGvuOhSgUejKbmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
        var TotalItems=document.querySelectorAll('.total');
        var dateItems=document.querySelectorAll('.date');
        var subTotal=[];
        var date=[];
        for (let i = 0; i < TotalItems.length; i++) {
            subTotal.push(TotalItems[i].value);

        }
        for (let i = 0; i < dateItems.length; i++) {
            date.push(dateItems[i].value);

        }
        var options1 = {
            series: [{
                name: "Order",
                data: subTotal,
            }],
            chart: {
                height: 350,
                type: 'line',
            zoom: {
                enabled: false
            }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: date,
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-order-day"), options1);
        chart1.render();


        var ProductName=document.querySelectorAll('.product_name');
        var ProductQty=document.querySelectorAll('.product_qty');
        var products=[];
        var qty=[];
        for (let i = 0; i < ProductName.length; i++) {
            products.push(ProductName[i].value);

        }
        for (let i = 0; i < ProductQty.length; i++) {
            qty.push(ProductQty[i].value);

        }

        var options2 = {
          series: [{
            name: "Order",
            data: qty,
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val;
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },

        xaxis: {
          categories: products,
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val;
            }
          }

        },
        title: {
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart2 = new ApexCharts(document.querySelector("#chart-products-qty"), options2);
        chart2.render();


</script>

@endsection
