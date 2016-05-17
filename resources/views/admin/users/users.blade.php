@extends('admin.index')

@section('content')
<section class="content-wrapper">
            @if(true)
            <section class="content-header">
              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/create_user') }}">
                <i class="fa fa-plus-square-o"></i> Create User
              </a>
            </section>
            <br>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">All Users</div>

                <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td>Email</td>
                          <td>Created At</td>
                          <td>Last Updated at</td>
                          <td>Edit</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $key=>$value)
                          <tr>
                            <td> {{ $value->name }} </td>
                            <td> {{ $value->email }} </td>
                            <td> {{ $value->created_at }} </td>
                            <td> {{ $value->updated_at }} </td>
                            <td>
                              <a class="btn btn-small btn-info" href="{{ URL::to('administrator/edit_users') }}">
                                <i class="fa fa-edit"></i> Edit</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
  </section>
@endsection
