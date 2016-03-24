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
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">All Scouts</h3>
      </div>
      <div class="box-body">
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
              <a href="{{ URL::to('scout/' . $scout->id . '/schedule') }}"><i class="fa fa-edit"> Edit Schedule</i></a> |
              <a href="{{ URL::to('scout_print_view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"> Print Schedule</i></a> |
              <a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"> Edit Scout</i></a> |
              <a type="button" href="#" onclick="open_modal('are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')">
                <i class="fa fa-trash"> Delete Scout</i>
              </a>
            </td>
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
  });
</script>
@endsection
