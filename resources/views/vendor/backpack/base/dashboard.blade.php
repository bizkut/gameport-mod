@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ config('settings.page_name')}} App Overview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
  {!! Charts::assets('chartjs') !!}

  <!-- =========================================================== -->

  @if($security)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Security Alert!</h4>
      Please set the permissions of the /.env and/or /config/app.php files to 0664.
    </div>
  @endif

  @if($giantbomb)
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> GiantBomb Warning!</h4>
      Please set your GiantBomb API Key in the <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/settings/game') }}">settings</a>. Otherwise, the game adding feature may not work properly.
    </div>
  @endif


  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$listings->count()}}</h3>

          <p>Listings</p>
        </div>
        <div class="icon">
          <i class="fa fa-tags"></i>
        </div>
        <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/listing') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$offers->count()}}</h3>

          <p>Offers</p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
        <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/offer') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$games->count()}}</h3>

          <p>Games</p>
        </div>
        <div class="icon">
          <i class="fa fa-gamepad"></i>
        </div>
        <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/game') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$users->count()}}</h3>

          <p>User</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/user') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->

  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-default"><i class="fa fa-credit-card"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Complete Payments</span>
          <span class="info-box-number">{{$payments->count()}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Received Money</span>
          <span class="info-box-number">{{ money(abs(filter_var(number_format($payments->sum('total'),2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-minus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Transaction Fees</span>
          <span class="info-box-number">{{ money(abs(filter_var(number_format($transaction_fees = $payments->sum('transaction_fee'),2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Earnings</span>
          <span class="info-box-number">{{ money(abs(filter_var(number_format($transactions->where('type','fee')->sum('total') - $transaction_fees,2), FILTER_SANITIZE_NUMBER_INT)), config('settings.currency'))->format(true) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-md-6">
      <div class="box box-info">
        {!! $chart_listing->render() !!}
      </div>
    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
      <div class="box box-success">
        {!! $chart_offer->render() !!}
      </div>
    </div>
    <!-- /.col (RIGHT) -->
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Members</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              {!! $chart_user->render() !!}
            </div>
            <div class="col-md-6">
              <p class="text-center">
                <strong>Last Users</strong>
              </p>
              <ul class="users-list clearfix">
                @foreach($users->slice(0, 8) as $user)
                <li>
                  <img src="{{$user->avatar_square}}" alt="{{$user->name}}'s Image" style="height: 80px; width: 80px;">
                  <a class="users-list-name" href="{{$user->url}}" target="_blank">{{$user->name}}</a>
                  <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                </li>
                @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
          </div>
        </div>
        <div class="box-footer text-center">
          <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/user') }}" class="uppercase">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
    <!-- /.col (LEFT) -->
  </div>
  <!-- /.row -->

  @if($version_response == config('settings.script_version'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> GamePort Script Up to Date</h4>
      You are running the latest GamePort script version <strong>{{config('settings.script_version')}}</strong>!
    </div>
  @else
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> GamePort Script update available!</h4>
      Your are running an old GamePort script version ({{config('settings.script_version')}}). Please update to version <strong>{{ $version_response }}</strong>!
    </div>
  @endif

  <!-- =========================================================== -->
@endsection

@section('after_scripts')

<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

  });
</script>
@endsection
