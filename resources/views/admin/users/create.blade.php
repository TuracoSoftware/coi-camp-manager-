@extends('admin.index')

@section('content')
<div class="container">
    <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User Registration</div>

                  <div class="panel-body">
                    <div class="form">

                      <form action="{{ url('display_users') }}"  method="POST">
                        {!! csrf_field() !!}

                        <label for="name">Name:</label>
                        <input name="name" type="text" class="form-control" id="name" required="required">
                        @if($errors->first('firstname'))
                          <span class="error">The user's name is required</span>
                        @endif
                        <br>
                        <label for="email">E-mail:</label>
                        <input name="eamil" type="text" class="form-control" id="email">
                        <br>
                        <label for"password">Password:</label>
                        <input name="password" type="text" class="form-control" id="password">
                        <br>
                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Register User
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
