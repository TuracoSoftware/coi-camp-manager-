@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  </section>
  <section class="content">
  <div class="panel panel-default">
    <div class="panel-heading">All Staff</div>
    <div class="panel-body">
      <table id="staff_table" class="table table-hover">
        <thead>
          <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Description</td>
            <td>Department</td>
          </tr>
        </thead>
        <tbody>
          @foreach($staff as $key=>$value)
            <tr>
              <td> {{ $value->user->name }} </td>
              <td> {{ $value->user->email }} </td>
              <td> {{ $value->description }} </td>
              <td> {{ $value->department }} </td>
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
    $('#staff_table').DataTable({
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
