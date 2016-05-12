@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Register a Scoutmaster</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scoutmaster') }}" method="POST">
              {!! csrf_field() !!}
              <label for="scoutmasterfirstname">Scoutmaster First Name:</label>
              <input name="firstname" type="text" class ="form-control" id="scoutmasterfirstname">
              <br>
              <label for="scoutmasterlastname">Scoutmaster Last Name</label>
              <input name="lastname" type="text" class="form-control" id="scoutmasterlastname">
              <br><input class="btn btn-default" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ~7Div0w2 -->
@endsection
