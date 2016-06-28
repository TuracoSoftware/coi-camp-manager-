@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  @if(Auth::user()->type == 'admin')
    <section class="content-header">
      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/staff/create') }}">
        <i class="fa fa-plus-square-o"></i> Create Staff Member
      </a>
    </section>
  @endif
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
                @if(Auth::user()->type == 'admin')
                  <td>Edit Profile</td>
                @endif
                @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
                  <td>Edit Schedule</td>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($staff as $key=>$value)
                <tr>
                  <td> {{ $value->user->name }} </td>
                  <td> {{ $value->user->email }} </td>
                  <td> {{ $value->description }} </td>
                  <td> {{ $value->department }} </td>
                  @if(Auth::user()->type == 'admin')
                    <td>
                      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/staff/' . $value->id . '/edit') }}">
                        <i class="fa fa-edit"></i> Edit Profile
                      </a>
                    </td>
                  @endif
                  @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director')
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-success">Edit Schedule</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/1/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 1</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/2/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 2</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/3/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 3</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/4/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 4</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/5/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 5</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/6/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 6</i></a></li>
                          <li><a href="{{ URL::to('/staff/'.$value->id.'/7/schedule') }}" target="_blank"><i class="fa fa-edit"> Week 7</i></a></li>
                        </ul>
                    </div>
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
