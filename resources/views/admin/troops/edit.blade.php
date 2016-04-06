@extends('admin.index')

@section('content')
<div class="container">
    <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Troop Editing</div>

                  <div class="panel-body">
                    <div class="form">
                      <form method="POST" action="{{ url('troop/'.$id) }}" >
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT">

                        <label for="firstname">Scoutmaster First Name:</label>
                        <input name="firstname" type="text" class="form-control" id="firstname" value="{{ $firstname }}">
                        @if($errors->first('firstname'))
                          <span class="error">{{$errors->first('firstname')}}</span>
                        @endif
                        <br>
                        <label for="lastname">Scoutmaster Last Name:</label>
                        <input name="lastname" type="text" class="form-control" id="lastname" value="{{ $lastname }}">
                        <br>
                        <label for"phone">Scoutmaster Phone:</label>
                        <input name="phone" type="text" class="form-control" id="phone" value="{{ $phone }}">
                        <br>
                        <label for"email">Scoutmaster Email:</label>
                        <input name="email" type="text" class="form-control" id="email" value="{{ $email }}">
                        <br>
                        <label for"troopnumber">Troop Number:</label>
                        <input name="troopnumber" type="text" class="form-control" pattern="[0-9]{3}" id="troopnumber" value="{{ $troopnumber }}">
                        <br>
                        <label for="council">Council</label>
                        <select name="council" class ="form-control" id="council">
                          @if($council == 'Blue Ridge Council')
                            <option value="Blue Ridge Council" selected>Blue Ridge Council</option>
                          @else
                            <option value="Blue Ridge Council">Blue Ridge Council</option>
                          @endif
                          @if($council == 'Indian Waters Council')
                            <option value="Indian Waters Council" selected>Indian Waters Council</option>
                          @else
                            <option value="Indian Waters Council">Indian Waters Council</option>
                          @endif
                          @if($council == 'Palmetto Council')
                            <option value="Palmetto Council" selected>Palmetto Council</option>
                          @else
                            <option value="Palmetto Council">Palmetto Council</option>
                          @endif
                        </select>
                        <br>
                        <label for="week">Week Attending Camp</label>
                        <select name="week" class="form-control" id="week">
                          @if($week == 1)
                            <option value="1" selected>Week 1</option>
                          @else
                            <option value="1">Week 1</option>
                          @endif
                          @if($week == 2)
                            <option value="2" selected>Week 2</option>
                          @else
                            <option value="2">Week 2</option>
                          @endif
                          @if($week == 3)
                            <option value="3" selected>Week 3</option>
                          @else
                            <option value="3">Week 3</option>
                          @endif
                          @if($week == 4)
                            <option value="4" selected>Week 4</option>
                          @else
                            <option value="4">Week 4</option>
                          @endif
                          @if($week == 5)
                            <option value="5" selected>Week 5</option>
                          @else
                            <option value="5">Week 5</option>
                          @endif
                          @if($week == 6)
                            <option value="6" selected>Week 6</option>
                          @else
                            <option value="6">Week 6</option>
                          @endif
                          @if($week == 7)
                            <option value="7" selected>Week 7</option>
                          @else
                            <option value="7">Week 7</option>
                          @endif
                          @if($week == 8)
                            <option value="8" selected>Week 8</option>
                          @else
                            <option value="8">Week 8</option>
                          @endif
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-save"></i>  Save
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
