@extends('admin.index')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      Welcome to the Admin Area.
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Your Page Content Here -->
    <h4>Recent Troops created</h4>
    <div class="panel panel-default">

        <div class="panel-body">
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
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
