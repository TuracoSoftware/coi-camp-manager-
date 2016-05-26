@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  <h2 class="page-header">Register a Scout</h2>
  </section>
  <section class="content">
    <div class="nave-tabs-custom">
        <div class="tab-content">
          <div class ="tab-pane active">
              <form action="{{ url('scout')}}" method="post">
                {!! csrf_field() !!}
                    <table class="table table-hover">
                      <tr>
                        <label for="scoutfirstname">Scout First Name:</label>
                        <input name="firstname" type="text" class ="form-control" id="scoutfirstname">
                      </tr>
                      <tr>
                        <label for="scoutmasterlastname">Scout Last Name</label>
                        <input name="lastname" type="text" class="form-control" id="scoutlastname">
                      </tr>
                      <tr>
                        <label for="age">Scout's Age at Start of Week Attending Camp:</label>
                        <select name="age" class ="form-control" id ="age">
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                        </select>
                      </tr>
                      <tr>
                        <label for="troop">Troop:</label>
                        <select name="troop" class="form-control">
                          @foreach($troops as $key=>$troop)
                            <option value="{{ $troop->id }}">Troop {{ $troop->troop }}     Week: {{$troop->week_attending_camp}}     Council: {{$troop->council}}</option>
                          @endforeach
                        </select>
                      </tr>
                    </table>
                    <input class="btn btn-default" type="submit" value="Submit">
                  </form>
            </div>
          </div>
        </div>
      </section>
    </section>
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ("../resources/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <!-- DataTables -->
    <script src="{{ asset ("../resources/assets/admin/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset ("../resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <!-- FastClick -->
    <script src="{{ asset ("../resources/assets/admin/plugins/fastclick/fastclick.js") }}"></script>
@endsection


@section('custom_scripts')
  <script src="{{ URL::asset('../resources/assets/js/scouts.js') }}"></script>
@stop







<!--<div class="container">
  <br>
  <div class="row col-md-offset-1">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Register a Scout</div>
        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scout') }}" method="POST">
              {!! csrf_field() !!}
              <label for="scoutfirstname">Scout First Name:</label>
              <input name="firstname" type="text" class ="form-control" id="scoutfirstname">
              <br>
              <label for="scoutmasterlastname">Scout Last Name</label>
              <input name="lastname" type="text" class="form-control" id="scoutlastname">
              <br>
              <label for="age">Scout's Age at Start of Week Attending Camp:</label>
              <select name="age" class ="form-control" id ="age">
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
              </select>
              <br><input class="btn btn-default" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>-->
<!-- ~7Div0w2 -->
