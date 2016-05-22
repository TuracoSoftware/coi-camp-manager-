@extends('admin.index')

@section('content')
  <section class="content-wrapper">

    <section class="content-header">

      <h2 class="page-header">All Merit Badges</h2>

      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/meritbadge/create') }}"
        <i class="fa fa-plus-square"></i> New MeritBadge
      </a>

    </section>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">All Merit Badges</div>

      <div class="panel-body">
          <table id="meritbadge_table" class="table table-hover">
            <thead>
              <tr>
                <th>Picture</th>
                <th>Merit Badge Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($meritbadges as $key=>$meritbadge)
              <tr>
                <td>
                  <img src="{{ asset("../resources/assets/img/{$meritbadge->path_name}.jpg") }}" alt="" width="50" hight="50"/>
                </td>
                <td>{{$meritbadge->name}}</td>

                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Actions</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu"role="menu">
                      <li><a href="{{URL::to('meritbadge/' . $meritbadge->id . '/edit')}}">
                        <i class="fa fa-pencil-square-o"></i>Edit Merit Badge</a>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
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
        $('#meritbadge_table').DataTable({
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
