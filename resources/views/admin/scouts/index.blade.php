@extends('admin.index')

@section('content')

<section class="content-wrapper">

  <section class="content-header">

    <h2 class="page-header">Week {{ $week }}</h2>
      <!-- New Scout button -->
      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/scout/create') }}">
        <i class="fa fa-plus-square-o"></i> New Scout
     </a>

  </section>

  <section class="content">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all_scouts" data-toggle="tab">All Scouts</a></li>
          <li><a href="#all_troops" data-toggle="tab">All Troops</a></li>
          <li><a href="#all_classes" data-toggle="tab">All Classes</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="all_scouts">
            <table id="scout_table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Troop</th>
                  <th>Council</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Age</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($scouts as $key => $scout)
                <tr>
                  <td>{{ $scout->troop->troop }}</td>
                  <td>{{ $scout->troop->council }}</td>
                  <td>{{ $scout->lastname }}</td>
                  <td>{{ $scout->firstname }}</td>
                  <td>{{ $scout->age }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success">Actions</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::to('scout/' . $scout->id . '/schedule') }}"><i class="fa fa-edit"> Edit Schedule</i></a></li>
                        <li><a href="{{ URL::to('scout_print_view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"> Print Schedule</i></a></li>
                        <li><a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"> Edit Scout</i></a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')">
                          <i class="fa fa-trash"> Delete Scout</i>
                        </a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          <div class="tab-pane" id="all_troops">
            <table id="troop_table" class="table table-bordered table-hover">
              <thead>
                <th>Troop</th>
                <th>Council</th>
                <th>Scoutmaster Name</th>
                <th>Scoutmaster Phone</th>
                <th>Scoutmaster Email</th>
                <th>Actions</th>
              </thead>
              <tbody>
                @foreach($troops as $key => $troop)
                <tr>
                  <td>{{ $troop->troop }}</td>
                  <td>{{ $troop->council }}</td>
                  <td>{{ $troop->scout_master_last_name }}, {{ $troop->scout_master_first_name }}</td>
                  <td>{{ $troop->scout_master_phone }}</td>
                  <td>{{ $troop->scout_master_email }}</td>
                  <td>Actions</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="all_classes">
            <table id="classes_table" class="table table-bordered table-hover">
              <thead>
                <th>Day</th>
                <th>Class/Session</th>
                <th>Number Registred</th>
                <th>Actions</th>
              </thead>
              <tbody>
                @foreach($classes as $key => $class)
                <tr>
                  <td>{{ $class->day }}</td>
                  <td>{{ $class->name }}</td>
                  <td>{{ $class->count_scouts_by_week($troop->week) }}</td>
                  <td>Actions</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section>
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
    $('#scout_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#troop_table').DataTable({
      "paging":true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#classes_table').DataTable({
      "paging":true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
