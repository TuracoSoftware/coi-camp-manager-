@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  </section>
  <section class="content">
    <div class="panel panel-default">
      <div class="panel-heading">Class Registration</div>
      <div class="panel-body">
        <div class="form">
          <form action="{{ url('sclass') }}" method="POST">
          {!! csrf_field() !!}
            <label for="name">Class name:</label>
              <input name="name" type="text" class="form-control" id="name">
              @if($errors->first('name'))
                <span class="error">{{$errors->first('name')}}</span>
              @endif
            <br>
            <label for="department">Department:</label>
              <select name="department" class="form-control" id="department">
                <option value="Aquatics">Aquatics</option>
                <option value="Civil Development">Civil Development</option>
                <option value="Ecology and Conservation">Ecology and Conservation</option>
                <option value="Field Sports">Field Sports</option>
                <option value="First Aid">First Aid</option>
                <option value="Handicraft">Handicraft</option>
                <option value="Scoutcraft">Scoutcraft</option>
                <option value="STEAM">STEAM</option>
                <option value="High Adventure">High Adventure</option>
                <option value="Callahan Village<">Callahan Village</option>
                <option value="Special Programs">Special Programs</option>
              </select>
            <br>
            <label for="description">Description:</label>
              <input name="description" type="text" class="form-control" id="description">
              @if($errors->first('description'))
                <span class="error">{{$errors->first('description')}}</span>
              @endif
            <br>
            <label for="fee">Class Fee:</label>
              <input name="fee" type="text" class ="form-control" id="fee">
            <br>
            <label for="day">Day:</label>
              <select name="day" class ="form-control" id="day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
              </select>
            <br>
            <label for="duration">Class Duration:</label>
              <select name="duration" class ="form-control" id ="duration">
                <option value="AM Only">AM Only</option>
                <option value="PM Only">PM Only</option>
                <option value="AM & PM">AM & PM</option>
                <option value="Twilight">Twilight</option>
              </select>
            <label for="min_age">Minimum Age:</label>
              <select name="min_age" class ="form-control" id ="min_age">
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
              </select>
              @if($errors->first('min_age'))
                <span class="error">{{$errors->first('min_age')}}</span>
              @endif
            <br>
            <label for="size">Size:</label>
              <input name="size" type="text" class="form-control" id="size">
            <br>
            <button type="submit" class="btn btn-default">
              <i class="fa fa-check"></i> Create Class
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</section>
@endsection
