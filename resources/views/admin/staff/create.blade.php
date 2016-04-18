@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Register a Staff</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('staff') }}" method="POST">
              {!! csrf_field() !!}
              <label for="stafffirstname">Staff First Name:</label>
              <input name="firstname" type="text" class ="form-control" id="stafffirstname">
              <br>
              <label for="staflastname">Staff Last Name</label>
              <input name="lastname" type="text" class="form-control" id="stafflastname">
              <br>
              <label for="Posittion">Staff Position:</label>
              <select name="position" class ="form-control" id ="age">
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
              </select>
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
