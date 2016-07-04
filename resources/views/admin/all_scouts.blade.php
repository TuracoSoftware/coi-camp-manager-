@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  </section>
  <br>
  <section class="content">
    <div class="panel panel-default">
      <div class="panel-heading">All Scouts</div>
      <div class="panel-body">
        <table id="troop_table" class="table table-hover">
          <thead>
            <tr>
              <td>Name</td>
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
            @foreach($scouts as $key => $scout)
              <tr>
                <td>{{ $scout->lastname }}, {{ $scout->firstname }}</td>
                <td>{{ $scout->troop["troop"] }}</td>
                <td>{{ $scout->troop["council"] }}</td>
                <td>{{ $scout->troop["week_attending_camp"] }}</td>
                <td>{{ $scout->troop["scout_master_last_name"] }}, {{ $scout->troop["scout_master_first_name"] }}</td>
                <td>{{ $scout->troop["scout_master_phone"] }}</td>
                <td>{{ $scout->troop["scout_master_email"] }}</td>
                @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
                  <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('administrator/scout/' . $scout->id . '/edit') }}">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                  </td>
                @endif
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
