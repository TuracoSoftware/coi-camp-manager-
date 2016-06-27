@extends('layouts.index')

@section('content')

<section class="content-wrapper">
  <section class="content-header">

    <h2 class="page-header">Week {{ $week }}</h2>

  </section>

  <section class="content">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $class->name }}'s Scouts</div>

        <div class="panel-body">
            <table id="scout_table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Troop</th>
                  <th>Council</th>
                  <th>Age</th>
                </tr>
              </thead>
              <tbody>
                @foreach($scouts as $key => $scout)
                <tr>
                  <td>{{ $scout->lastname }}</td>
                  <td>{{ $scout->firstname }}</td>
                  <td>{{ $scout->troop->troop }}</td>
                  <td>{{ $scout->troop->council }}</td>
                  <td>{{ $scout->age }}</td>
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
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
