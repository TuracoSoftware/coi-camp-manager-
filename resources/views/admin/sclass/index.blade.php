@extends('admin.index')

@section('content')

<section class="content-wrapper">


            <section class="content-header">
              <a class="btn btn-small btn-info" href="{{ URL::to('sclass/create') }}">
                <i class="fa fa-plus-square-o"></i> New Class
              </a>
            </section><br>

            <div class="box">
                <div class="box-header">
                  <h3 class="box-header">Current Classes</h3>
                </div>

                <div class="box-body">
                    <table id="class_table" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Class Name</th>
                          <th>Description</th>
                          <th>Min Age</th>
                          <th>Fee</th>
                          <th>Duration</th>
                          <th>Day</th>
                          <th>Size</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sclass as $key => $value)
                          <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->min_age }}</td>
                            <td>{{ $value->fee }}</td>
                            <td>{{ $value->duration }}</td>
                            <td>{{ $value->day }}</td>
                            <td>{{ $value->size }}</td>

                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('sclass/' . $value->id . '/edit') }}">
                                <i class="fa fa-edit"></i> Edit</a>
                              <a type="button" class="btn btn-small btn-danger" href="#" onclick="open_modal('are you sure?', '{{ url('sclass/'.$value->id) }}', true, 'DELETE')">
                                  <i class="fa fa-trash"></i> Delete
                              </a>
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
<script src="{{  asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset ("../resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset ("../resources/assets/admin/plugins/fastclick/fastclick.js") }}"></script>

<script>
  $(function () {
    $('#class_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@stop
