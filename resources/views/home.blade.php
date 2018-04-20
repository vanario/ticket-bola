@extends('template')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="content-list">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $data['tot_nominal'] or "-"}}<sup style="font-size: 20px"></sup></h3>
                        <p>Pengahasilan</p>
                    </div>
                    <div class="icon">
                        <i class="ion-calculator"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $data['tot_tiket'] or "-" }}</h3>

                        <p>Total Tiket</p>
                     </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                         <h3>30 Ribu</h3>

                         <p style="font-size: 14px">Penjualan Tiket Non Membership</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

            <!-- Donut chart -->
            <div class="col-md-9">
              <!-- LINE CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">Penjualan Tiket Tribun Tahunan</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="line-chart" style="height: 300px;"></div>
                    </div>
                  <!-- /.box-body-->
                </div>
                <!-- /.box-body -->
            </div>

            <div class="col-md-3">  
                <p class="text-center">
                    <strong>Static Penjualan Tiket Tribun</strong>
                </p>

                <div class="progress-group">
                    <span class="progress-text">Tribun Barat</span>
                    <span class="progress-number"><b>160</b>/200</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                    <span class="progress-text">Tribun Timur</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                    <span class="progress-text">VIP</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                </div>

                <div class="progress-group">
                    <span class="progress-text">VVIP</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                </div>
                <!-- /.progress-group -->
                <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                </div>
                      <!-- /.progress-group -->
            </div>
               
        </div>
    </div>
@endsection

@section('script')

<script src="{{ asset('adminlte/bower_components/Flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('adminlte/bower_components/Flot/jquery.flot.resize.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('adminlte/bower_components/Flot/jquery.flot.pie.js') }}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{ asset('adminlte/bower_components/Flot/jquery.flot.categories.js') }}"></script>

<script type="text/javascript">

$(function () {
    var data = [], totalPoints = 100

    function getRandomData() {

        if (data.length > 0)
          data = data.slice(1)

        // Do a random walk
        while (data.length < totalPoints) {

          var prev = data.length > 0 ? data[data.length - 1] : 50,
              y    = prev + Math.random() * 10 - 5

          if (y < 0) {
            y = 0
          } else if (y > 100) {
            y = 100
          }

          data.push(y)
        }

        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
          res.push([i, data[i]])
        }

        return res
      }
 /*
   * LINE CHART
   * ----------
   */
  //LINE randomly generated data

  var sin = [], cos = []
  for (var i = 0; i < 14; i += 0.5) {
    sin.push([i, Math.sin(i)])
    cos.push([i, Math.cos(i)])
  }
  var line_data1 = {
    data : sin,
    color: '#3c8dbc'
  }
  var line_data2 = {
    data : cos,
    color: '#00c0ef'
  }
  $.plot('#line-chart', [line_data1, line_data2], {
    grid  : {
      hoverable  : true,
      borderColor: '#f3f3f3',
      borderWidth: 1,
      tickColor  : '#f3f3f3'
    },
    series: {
      shadowSize: 0,
      lines     : {
        show: true
      },
      points    : {
        show: true
      }
    },
    lines : {
      fill : false,
      color: ['#3c8dbc', '#f56954']
    },
    yaxis : {
      show: true
    },
    xaxis : {
      show: true
    }
  })
  //Initialize tooltip on hover
  $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
    position: 'absolute',
    display : 'none',
    opacity : 0.8
  }).appendTo('body')
  $('#line-chart').bind('plothover', function (event, pos, item) {

    if (item) {
      var x = item.datapoint[0].toFixed(2),
          y = item.datapoint[1].toFixed(2)

      $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
        .css({ top: item.pageY + 5, left: item.pageX + 5 })
        .fadeIn(200)
    } else {
      $('#line-chart-tooltip').hide()
    }

  })
  /* END LINE CHART */

/*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      { label: 'Series2', data: 30, color: '#3c8dbc' },
      { label: 'Series3', data: 20, color: '#0073b7' },
      { label: 'Series4', data: 50, color: '#00c0ef' }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

function labelFormatter(label, series) {
  return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
    + label
    + '<br>'
    + Math.round(series.percent) + '%</div>'
}   
</script>

@endsection
            