@extends('admin.index')

@section('content')

<section class="content-wrapper">
  <section class="content-header">
    <h2 class="page-header">Roster</h2>
  </section>

  <section class="content">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#all_scouts" data-toggle="tab">All Scouts</a></li>
          <li><a href="#all_classes" data-toggle="tab">All Classes</a></li>
          <li><a href="#week1" data-toggle="tab">Week 1</a></li>
          <li><a href="#week2" data-toggle="tab">Week 2</a></li>
          <li><a href="#week3" data-toggle="tab">Week 3</a></li>
          <li><a href="#week4" data-toggle="tab">Week 4</a></li>
          <li><a href="#week5" data-toggle="tab">Week 5</a></li>
          <li><a href="#week6" data-toggle="tab">Week 6</a></li>
          <li><a href="#week7" data-toggle="tab">Week 7</a></li>
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
                        <li><a href="{{ URL::to('scout_print_view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"> Print Schedule</i></a></li>
                        <li class="divider"></li>
                      </ul>
                    </div>
                  </td>
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
                  <td>{{ $class->count_scouts_week($week) }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success">Actions</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::to('roster_print_view/' . $class->id . '/' . $week) }}"><i class="fa fa-print">Print Roster</i></a></li>
                      </ul>
                    </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </div>
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
