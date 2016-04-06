@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Class Editing</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('sclass/'.$id) }}" method="POST">
              {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">
              
              <label for="name">Class Name:</label>
              <input name="name" type="text" class ="form-control" id="name" value="{{ $name }}">
              <br>
              <label for="description">Class Description:</label>
              <input name="description" type="text" class="form-control" id="description" value="{{ $description }}">
              <br>
              <label for="min_age">Minimun Age Permitted:</label>
              <input name="min_age" class ="form-control" id="min_age" value="{{ $min_age }}">

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