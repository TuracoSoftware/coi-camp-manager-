@extends('admin.index')

@section('content')
<div class="container">
  <br>
  <div class="row col-md-offset-1">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Register a Scout</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scout') }}" method="POST">
              {!! csrf_field() !!}
              <label for="scoutfirstname">Scout First Name:</label>
              <input name="firstname" type="text" class ="form-control" id="scoutfirstname">
              <br>
              <label for="scoutmasterlastname">Scout Last Name</label>
              <input name="lastname" type="text" class="form-control" id="scoutlastname">
              <br>
              <label for="age">Scout's Age at Start of Week Attending Camp:</label>
              <select name="age" class ="form-control" id ="age">
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