@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Scoutmaster Regstration</div>

                  <div class="panel-body">
                    <div class="form">

                      <form action="{{ url('troop') }}"  method="POST">
                        {!! csrf_field() !!}

                        <label for="firstname">Scoutmaster First Name:</label>
                        <input name="firstname" type="text" class="form-control" id="firstname" required="required">
                        @if($errors->first('firstname'))
                          <span class="error">First Name is required</span>
                        @endif
                        <br>
                        <label for="lastname">Scoutmaster Last Name:</label>
                        <input name ="lastname" type="text" class="form-control" id="lastname">
                        <br>
                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Register Scoutmaster
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{ asset ("../resources/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset ("../resources/assets/admin/plugins/select2/select2.full.min.js") }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset ("../resources/assets/admin/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- InputMask -->
<script src="{{ asset("../resources/assets/admin/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("../resources/assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("../resources/assets/admin/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>

<script>
$(function () {
  $(".select2").select2();

  $("[data-mask]").inputmask();

  });
</script>
@endsection
