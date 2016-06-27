@extends('layouts.index')

@section('content')
<section class="content-wrapper">
            <section class="content-header">
              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/director/create') }}">
                <i class="fa fa-plus-square-o"></i> Create Director
              </a>
            </section>
            <section class="content">
            
            <div class="panel panel-default">
                <div class="panel-heading">All Directors</div>

                <div class="panel-body">
                    <table id="director_table" class="table table-hover">
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td>Email</td>
                          <td>Description</td>
                          <td>Department</td>
                          <td>Edit</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($director as $key=>$value)
                          <tr>
                            <td> {{ $value->user->name }} </td>
                            <td> {{ $value->user->email }} </td>
                            <td> {{ $value->description }} </td>
                            <td> {{ $value->department }} </td>
                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/director/' . $value->id . '/edit') }}">
                                <i class="fa fa-edit"></i> Edit</a>
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
      $('#director_table').DataTable({
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
