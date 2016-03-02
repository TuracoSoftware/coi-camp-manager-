@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <div style="margin: 12px;">
              <a class="btn btn-small btn-info" href="{{ URL::to('session/create') }}">
                <i class="fa fa-plus-square-o"></i> New Session
              </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Current Information</div>

                <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Session day</td>
                          <td>Department</td>
                          <td>Class</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sessions as $key => $value)
                          <tr>
                            <td>{{ $value->troop }}</td>
                            <td>{{ $value->council }}</td>
                            <td>{{ $value->week_attending_camp }}</td>

                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('session/' . $value->id . '/edit') }}">
                                <i class="fa fa-edit"></i> Edit</a>
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
