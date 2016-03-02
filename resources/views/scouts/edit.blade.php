@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Scout Editing</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scout/'.$id) }}" method="POST">
              {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">
              
              <label for="scoutfirstname">Scout First Name:</label>
              <input name="firstname" type="text" class ="form-control" id="scoutfirstname" value="{{ $firstname }}">
              <br>
              <label for="scoutmasterlastname">Scout Last Name</label>
              <input name="lastname" type="text" class="form-control" id="scoutlastname" value="{{ $lastname }}">
              <br>
              <label for="age">Scout's Age at Start of Week Attending Camp:</label>
              <select name="age" class ="form-control" id ="age">
                @if($age == 11)
                  <option value="11" selected>11</option>
                @else
                  <option value="11">11</option>
                @endif
                 @if($age == 12)
                  <option value="12" selected>12</option>
                @else
                  <option value="12">12</option>
                @endif
                 @if($age == 13)
                  <option value="13" selected>13</option>
                @else
                  <option value="13">13</option>
                @endif
                 @if($age == 14)
                  <option value="14" selected>14</option>
                @else
                  <option value="14">14</option>
                @endif
                 @if($age == 15)
                  <option value="15" selected>15</option>
                @else
                  <option value="15">11</option>
                @endif
                 @if($age == 16)
                  <option value="16" selected>16</option>
                @else
                  <option value="16">16</option>
                @endif
                 @if($age == 17)
                  <option value="17" selected>17</option>
                @else
                  <option value="17">17</option>
                @endif
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