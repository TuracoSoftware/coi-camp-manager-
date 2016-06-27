@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
    <h1>Welcome {{ Auth::user()->name }}!</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $scout_count }}</h3>
            <p>Scouts Registered</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ URL::to('administrator/all_scouts') }}" class="small-box-footer">View All Scouts <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $troop_count }}</h3>
            <p>Troops Registered</p>
          </div>
          <div class="icon">
            <i class="fa fa-bank"></i>
          </div>
          <a href={{ URL::to('/troop') }} class="small-box-footer">View All Troops <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>${{ $total_fee }}</h3>
            <p>Estimated Total Fees</p>
          </div>
          <div class="icon">
            <i class="fa fa-dollar"></i>
          </div>
          <a href="#" class="small-box-footer">View fee breakdown<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>65</h3>
            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#last-week" data-toggle="tab">Last Week</a></li>
            <li><a href="#sales-chart" data-toggle="tab">Last 3 Days</a></li>
            <li><a href="#last-day" data-toggle="tab">Last Day</a></li>
            <li class="pull-left header"><i class="fa fa-plus"></i> Recent Troop Registrations</li>
          </ul>
          <div class="tab-content no-padding">
            <div class="tab-content">
              <div class="tab-pane active" id="last-week">
                <table id="last-week" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td>Troop Number</td>
                      <td>Council</td>
                      <td>Week</td>
                      <td>Scoutmaster Name</td>
                      <td>Phone Number</td>
                      <td>Email</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($troops_7 as $key => $value)
                      <tr>
                        <td>{{ $value->troop }}</td>
                        <td>{{ $value->council }}</td>
                        <td>{{ $value->week_attending_camp }}</td>
                        <td>{{ $value->scout_master_first_name }} {{ $value->scout_master_last_name }}</td>
                        <td>{{ $value->scout_master_phone }}</td>
                        <td>{{ $value->scout_master_email }}</td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/edit') }}">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/addscout') }}">
                            <i class="fa fa-edit"></i> Add scout
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="last-day">
                <table id="last-day" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td>Troop Number</td>
                      <td>Council</td>
                      <td>Week</td>
                      <td>Scoutmaster Name</td>
                      <td>Phone Number</td>
                      <td>Email</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($troops_1 as $key => $value)
                      <tr>
                        <td>{{ $value->troop }}</td>
                        <td>{{ $value->council }}</td>
                        <td>{{ $value->week_attending_camp }}</td>
                        <td>{{ $value->scout_master_first_name }} {{ $value->scout_master_last_name }}</td>
                        <td>{{ $value->scout_master_phone }}</td>
                        <td>{{ $value->scout_master_email }}</td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/edit') }}">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/addscout') }}">
                            <i class="fa fa-edit"></i> Add scout
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="sales-chart">
                <table id="sales-chart" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td>Troop Number</td>
                      <td>Council</td>
                      <td>Week</td>
                      <td>Scoutmaster Name</td>
                      <td>Phone Number</td>
                      <td>Email</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($troops_3 as $key => $value)
                      <tr>
                        <td>{{ $value->troop }}</td>
                        <td>{{ $value->council }}</td>
                        <td>{{ $value->week_attending_camp }}</td>
                        <td>{{ $value->scout_master_first_name }} {{ $value->scout_master_last_name }}</td>
                        <td>{{ $value->scout_master_phone }}</td>
                        <td>{{ $value->scout_master_email }}</td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/edit') }}">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/addscout') }}">
                            <i class="fa fa-edit"></i> Add scout
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Paperwork Status</h3>
          </div>
          <div class="box-body">
            <p>This function is coming soon</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>
@endsection
