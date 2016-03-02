@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Session Registration</div>

                  <div class="panel-body">
                    <div class="form">
                    
                      <form action="{{ url('session') }}" method="POST">
                        {!! csrf_field() !!}
                        <label for="day">Session day</label>
                        <select name="day" class="form-control" id="day">
                          <option value="1">Monday</option>
                          <option value="2">Tuesday</option>
                          <option value="3">Wednesday</option>
                          <option value="4">Thursday</option>
                          <option value="5">Friday</option>
                        </select>
                        <br>
                        <label for="department">Department:</label>
                        <select name="department" class="form-control" id="department">
                          <option value="1">Aquatics</option>
                          <option value="2">Civil Development</option>
                          <option value="3">Ecology and Conservation</option>
                          <option value="4">Field Sports</option>
                          <option value="5">First Aid</option>
                          <option value="6">Handicraft</option>
                          <option value="7">Scoutcraft</option>
                          <option value="8">STEAM</option>
                          <option value="9">High Adventure</option>
                        </select>
                        @if($errors->first('department'))
                          <span class="error">{{$errors->first('department')}}</span>
                        @endif
                        <br>
                        <label for="class">Department:</label>
                        <select name="class" class="form-control" id="class">
                          <option value="1">Loaded by department</option>
                        </select>
                        @if($errors->first('class'))
                          <span class="error">{{$errors->first('class')}}</span>
                        @endif
                        <br>
                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Register Session
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
