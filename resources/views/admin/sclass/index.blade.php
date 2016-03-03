@extends('admin.index')

@section('content')

<section class="content-wrapper">


            <section class="content-header">
              <a class="btn btn-small btn-info" href="{{ URL::to('sclass/create') }}">
                <i class="fa fa-plus-square-o"></i> New Class
              </a>
            </section><br>

            <div class="panel panel-default">
                <div class="panel-heading">Current Information</div>

                <div class="panel-body">

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Class Name</td>
                          <td>Description</td>
                          <td>Min Age</td>
                          <td>Fee</td>
                          <td>Duration</td>
                          <td>Day</td>
                          <td>Size</td>
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
@stop
