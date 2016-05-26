@extends('layouts.index')

@section('content')
<div class="container">
    <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                  <div class="panel-body">
                    <div class="form">

                      <form action="{{ url('administrator/meritbadge') }}"  method="POST">
                        {!! csrf_field() !!}

                        <!--<label for="name">Merit Badge Name:</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <br>-->

                        <div class="box box-info">
                          <div class="box-header with-border">
                            <h3 class="box-title">Create a Merit Badge</h3>
                          </div>
                          <!-- /.box-header -->
                          <!-- form start -->
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
                            <!-- /.box-footer -->
                          </form>
                        </div><!--
                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Make Merit Badge
                        </button>-->
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!--
<section class="content-wrapper">

  <section class="contenet-header">

    <h2 class="page-header">Create a Merit Badge</h2>
  </section>
  <section class="content">
    <div class="form">
      <form action="{{ URL::to('meritbadge') }}" method="POST">
        {!! csrf_field() !!}
        <label for="name">Merit Badge Name:</label>
        <input name="name" type="text" class="form-control" id="name"></input>
      </form>
    </section>-->
@endsection
