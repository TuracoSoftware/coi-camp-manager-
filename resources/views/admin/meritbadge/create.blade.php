@extends('layouts.index')

@section('content')
<section class="container">
  <br>
  <div class="row col-md-offset-1">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form">
            <form action="{{ url('administrator/meritbadge') }}"  method="POST">
            {!! csrf_field() !!}
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Create a Merit Badge</h3>
                </div>
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Merit Badge Name:</label>
                        <div class="col-sm-10">
                          <input type="name" class="form-control" id="inputEmail3" placeholder="Name">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Requirments</label>
                      <textarea type="requirements" class="form-control" rows="3" placeholder="1a ..."></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image Input</label>
                      <input type="file" id="exampleInputFile">
                      <p class="help-block">Put in a picture of the Merit Bage here</p>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Make Merit Badge</button>
                  </div>
                </form>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
