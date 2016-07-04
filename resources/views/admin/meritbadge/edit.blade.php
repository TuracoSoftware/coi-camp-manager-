@extends('layouts.index')

@section('content')
<section class="container">
  <br>
  <div class="row col-md-offset-1">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form">
            <form method="POST" action="{{ url('administrator/meritbadge/' . $id) }}" >
            {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">
              <label for="title">Requirement Title</label>
                <input name="title" type="text" class="form-control" id="title">
              <br>
              <label for="requirement">Requirement</label>
                <input name="requirement" type="text" class="form-control" id="requirement">
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
</section>
@endsection
