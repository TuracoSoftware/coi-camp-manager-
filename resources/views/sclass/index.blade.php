@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="mar-12">
              <a class="btn btn-small btn-info" href="{{ URL::to('sclass/create') }}">
                <i class="fa fa-plus-square-o"></i> New Class
              </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Current Information</div>

                <div class="panel-body">

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Class Name</td>
                          <td>Class description</td>
                          <td>Min Age</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sclass as $key => $value)
                          <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->min_age }}</td>

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
        </div>
    </div>
</div>
@endsection
