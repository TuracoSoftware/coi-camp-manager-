@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="mar-12">
              <a class="btn btn-small btn-info" href="{{ URL::to('scout/create') }}">
                <i class="fa fa-plus-square-o"></i> New Scout
              </a>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Current Information</div>

                <div class="panel-body">

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Scout Name</td>
                          <td>Scout Age</td>
                          <td>Troop id</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($scouts as $key => $value)
                          <tr>
                            <td>{{ $value->firstname }} {{ $value->lastname }}</td>
                            <td>{{ $value->age }}</td>
                            <td>{{ $value->troop_id }}</td>

                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('scout/' . $value->id . '/edit') }}">
                                <i class="fa fa-edit"></i> Edit</a>
                              <form action="{{ url('scout/'.$value->id) }}" method="POST">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="DELETE">
                                <a class="btn btn-small btn-danger" href="#">
                                  <button type="submit" class="hidden">
                                    <i class="fa fa-trash"></i> Delete
                                  </button>
                                </a>
                              </form>
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
