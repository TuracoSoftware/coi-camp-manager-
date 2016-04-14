@extends('admin.index')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>Welcome {{ Auth::user()->name }}!
        <small>{{ Auth::user()->type }}</small>
      </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <!-- Displays total number of scouts registered for the summer -->
            <h3>{{ $scouts }}</h3>

            <p>Scouts Registered</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ URL::to('/scout') }}" class="small-box-footer">View All Scouts <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <!-- TODO: Displays total number of troops registered for the summer -->
            <h3>{{ $troop_count }}</h3>

            <p>Troops Registered</p>
          </div>
          <div class="icon">
            <i class="fa fa-bank"></i>
          </div>
          <a href={{ URL::to('/troop') }} class="small-box-footer">View All Troops <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <!-- TODO: Diplays the total amount of fees expected to be collected this summer -->
            <h3>###</h3>

            <p>Estimated Total Fees</p>
          </div>
          <div class="icon">
            <i class="fa fa-dollar"></i>
          </div>
          <a href="#" class="small-box-footer">View fee breakdown<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>65</h3>
            <!-- TODO: Add something else useful here -->
            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Your Page Content Here -->
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
          <!-- Tabs within a box -->
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#last-day" data-toggle="tab">Last Day</a></li>
            <li><a href="#sales-chart" data-toggle="tab">Last 3 Days</a></li>
            <li class="pull-left header"><i class="fa fa-plus"></i> Recent Troop Registrations</li>
          </ul>
          <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="last-day">
                <table class="table table-hover">
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
                    @foreach($troops as $key => $value)
                      <tr>
                        <td>{{ $value->troop }}</td>
                        <td>{{ $value->council }}</td>
                        <td>{{ $value->week_attending_camp }}</td>
                        <td>{{ $value->scout_master_first_name }} {{ $value->scout_master_last_name }}</td>
                        <td>{{ $value->scout_master_phone }}</td>
                        <td>{{ $value->scout_master_email }}</td>

                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/edit') }}">
                            <i class="fa fa-edit"></i> Edit</a>
                        </td>
                        <td>
                          <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/addscout') }}">
                            <i class="fa fa-edit"></i> Add scout</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Paperwork Status</h3>
            </div>
            <div class="box-body">
              <!-- TODO: Inster functionalty to show what paperwork needs to be done for the day -->
              <p>This function is coming soon</p>
            </div>
          </div>
        </div>
      </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
