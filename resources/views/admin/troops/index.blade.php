@extends('layouts.index')

@section('content')

<section class="content-wrapper">

            @if($notroop)
            <section class="content-header">
              <h1>Troops</h1>
              @if(Auth::user()->type == 'admin')
              <a class="btn btn-small btn-info pull-right" href="{{ URL::to('troop/create') }}">
                <i class="fa fa-plus-square-o"></i> Register Troop
              </a>
              @elseif(Auth::user()->type == 'director')
              <a class="btn btn-small bg-purple pull-right" href="{{ URL::to('troop/create') }}">
                <i class="fa fa-plus-square-o"></i> Register Troop
              </a>
              @elseif(Auth::user()->type == 'staff')
              <a class="btn btn-small btn-danger pull-right" href="{{ URL::to('troop/create') }}">
                <i class="fa fa-plus-square-o"></i> Register Troop
              </a>
              @endif
            </section>
            <br>
            @endif
            <div class="content">
            <div class="panel panel-default">
                <div class="panel-heading">All Troops</div>

                <div class="panel-body">
                    <table id="troop_table" class="table table-hover">
                      <thead>
                        <tr>
                          <td>Troop Number</td>
                          <td>Council</td>
                          <td>Week</td>
                          <td>Scoutmaster Name</td>
                          <td>Phone Number</td>
                          <td>Email</td>
                          @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
                          <td>Actions</td>
                          @endif
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
                            @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/edit') }}">
                                <i class="fa fa-edit"></i> Edit</a>
                              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/' . $value->id . '/addscout') }}">
                                <i class="fa fa-edit"></i> Add scout</a>
                            </td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
  </section>
  <!-- Scripts Required for DataTable -->

  <!-- jQuery 2.1.4 -->
  <script src="{{ asset ("../resources/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
  <!-- DataTables -->
  <script src="{{ asset ("../resources/assets/admin/plugins/datatables/jquery.dataTables.min.js") }}"></script>
  <script src="{{ asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset ("../resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
  <!-- FastClick -->
  <script src="{{ asset ("../resources/assets/admin/plugins/fastclick/fastclick.js") }}"></script>

  <script>
    $(function () {
      $('#troop_table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
@endsection
