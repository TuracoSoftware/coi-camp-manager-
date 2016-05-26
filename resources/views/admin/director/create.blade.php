@extends('layouts.index')

@section('content')
<div class="container">
    <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Director Registration</div>

                  <div class="panel-body">
                    <div class="form">

                      <form action="{{ url('administrator/director') }}"  method="POST">
                        {!! csrf_field() !!}

                        <label for="name">Name:</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <br>
                        <label for="email">Email:</label>
                        <input name="email" type="text" class="form-control" id="email">
                        <br>
                        <label for"password">Password:</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <br>

                        <label for="description">Description:</label>
                        <input name="description" type="text" class="form-control" id="description">
                        <br>
                        <label for="department">Department:</label>
                        <input name="department" type="text" class="form-control" id="department">
                        <br>

                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Register Director
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
