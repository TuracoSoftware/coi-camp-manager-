@extends('admin.index')

@section('content')
<div class="container">
  <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Class Registration</div>

                  <div class="panel-body">
                    <div class="form">
                      <form action="{{ url('sclass') }}" method="POST">
                        {!! csrf_field() !!}
                        <label for="name">Class name:</label>
                        <input name="name" type="text" class="form-control" id="name">
                        @if($errors->first('name'))
                          <span class="error">{{ $errors->first('name') }}</span>
                        @endif
                        <br>
                        <label for="description">Description:</label>
                        <input name="description" type="text" class="form-control" id="description">
                        @if($errors->first('description'))
                          <span class="error">{{ $errors->first('description') }}</span>
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
        </div>
    </div>
</div>
@endsection
