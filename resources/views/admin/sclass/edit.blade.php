@extends('admin.index')

@section('content')
<div class="container">
  <br>
  <div class="row col-md-offset-1">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Class Editing</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('sclass/'.$id) }}" method="POST">
              {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">
              <label for="name">Class name:</label>
              <input name="name" type="text" class="form-control" id="name" value="{{ $name }}">
              @if($errors->first('name'))
                <span class="error">{{$errors->first('name')}}</span>
              @endif
              <br>
              <label for="department">Department:</label>
              <select name="department" class="form-control" id="department">
                @if($department == 'Aquatics')
                  <option value="1" selected>Aquatics</option>
                @else
                  <option value="1">Aquatics</option>
                @endif
                @if($department == 'Civil Development')
                  <option value="2" selected>Civil Development</option>
                @else
                  <option value="2">Civil Development</option>
                @endif
                @if($department == 'Ecology and Conservation')
                  <option value="3" selected>Ecology and Conservation</option>
                @else
                  <option value="3">Ecology and Conservation</option>
                @endif
                @if($department == 'Field Sports')
                  <option value="4" selected>Field Sports</option>
                @else
                  <option value="4">Field Sports</option>
                @endif
                @if($department == 'First Aid')
                  <option value="5" selected>First Aid</option>
                @else
                  <option value="5">First Aid</option>
                @endif
                @if($department == 'Handicraft')
                  <option value="6" selected>Handicraft</option>
                @else
                  <option value="6">Handicraft</option>
                @endif
                @if($department == 'Scoutcraft')
                  <option value="7" selected>Scoutcraft</option>
                @else
                  <option value="7">Scoutcraft</option>
                @endif
                @if($department == 'STEAM')
                  <option value="8" selected>STEAM</option>
                @else
                  <option value="8">STEAM</option>
                @endif
                @if($department == 'High Adventure')
                  <option value="9" selected>High Adventure</option>
                @else
                  <option value="9">High Adventure</option>
                @endif
              </select>
              <br>
              <label for="description">Description:</label>
              <input name="description" type="text" class="form-control" id="description" value="{{ $description }}">
              @if($errors->first('description'))
                <span class="error">{{$errors->first('description')}}</span>
              @endif
              <br>
              <label for="fee">Class Fee:</label>
              <input name="fee" type="text" class ="form-control" id="fee" value="{{ $fee }}">
              <br>
              <label for="day">Day:</label>
              <select name="day" class ="form-control" id="day">
                @if($day == 'Monday')
                  <option value="Monday" selected>Monday</option>
                @else
                  <option value="Monday">Monday</option>
                @endif
                @if($day == 'Tuesday')
                  <option value="Tuesday" selected>Tuesday</option>
                @else
                  <option value="Tuesday">Tuesday</option>
                @endif
                @if($day == 'Wednesday')
                  <option value="Wednesday" selected>Wednesday</option>
                @else
                  <option value="Wednesday">Wednesday</option>
                @endif
                @if($day == 'Thursday')
                  <option value="Thursday" selected>Thursday</option>
                @else
                  <option value="Thursday">Thursday</option>
                @endif
                @if($day == 'Friday')
                  <option value="Friday" selected>Friday</option>
                @else
                  <option value="Friday">Friday</option>
                @endif
              </select>
              <br>
              <label for="duration">Class Duration:</label>
              <select name="duration" class ="form-control" id ="duration">
                @if($duration == 'AM Only')
                  <option value="AM Only" selected>AM Only</option>
                @else
                  <option value="AM Only">AM Only</option>
                @endif
                @if($duration == 'PM Only')
                  <option value="PM Only" selected>PM Only</option>
                @else
                  <option value="PM Only">PM Only</option>
                @endif
                @if($duration == 'AM & PM')
                  <option value="AM & PM" selected>AM & PM</option>
                @else
                  <option value="AM & PM">AM & PM</option>
                @endif
                <!-- <option value="2 Days">2 Days</option> -->
                @if($duration == 'Twilight')
                  <option value="Twilight" selected>Twilight</option>
                @else
                  <option value="Twilight">Twilight</option>
                @endif
              </select>
              <label for="min_age">Minimum Age:</label>
              <select name="min_age" class ="form-control" id ="min_age">
                @if($min_age == '11')
                  <option value="11" selected>11</option>
                @else
                  <option value="11">11</option>
                @endif
                @if($min_age == '12')
                  <option value="12" selected>12</option>
                @else
                  <option value="12">12</option>
                @endif
                @if($min_age == '13')
                  <option value="13" selected>13</option>
                @else
                  <option value="13">13</option>
                @endif
                @if($min_age == '14')
                  <option value="14" selected>14</option>
                @else
                  <option value="14">14</option>
                @endif
                @if($min_age == '15')
                  <option value="15" selected>15</option>
                @else
                  <option value="15">15</option>
                @endif
                @if($min_age == '16')
                  <option value="16" selected>16</option>
                @else
                  <option value="16">16</option>
                @endif
                @if($min_age == '17')
                  <option value="17" selected>17</option>
                @else
                  <option value="17">17</option>
                @endif
              </select>
              @if($errors->first('min_age'))
                <span class="error">{{$errors->first('min_age')}}</span>
              @endif
              <br>
              <button type="submit" class="btn btn-default">
                <i class="fa fa-check"></i> Save
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ~7Div0w2 -->
@endsection