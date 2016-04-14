@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Troop Registration</div>

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
                        <label for"phone">Scoutmaster Phone:</label>
                        <input name ="phone" type="text" class="form-control" id="phone">
                        <br>
                        <label for"email">Scoutmaster Email:</label>
                        <input name="email" type="text" class="form-control" value="{{ Auth::user()->email }}" id="email">
                        <br>
                        <label for"troopnumber">Troop Number:</label>
                        <input name="troopnumber" type="text" class="form-control" pattern="[0-9]{3}" id="troopnumber">
                        <br>
                        <label for="council">Council</label>
                        <select name="council" class ="form-control" id="council">
                          <option value="Blue Ridge Council">Blue Ridge Council</option>
                          <option value="Alapaha Area Council">Alapaha Area Council</option>
                          <option value="Atlant Area Council">Atlanta Area Council</option>
                          <option value="Cape Fear Council">Cape Fear Council</option>
                          <option value="Central Florida Council">Central Florida Council</option>
                          <option value="Central Georgia Council">Central Georgia Council</option>
                          <option value="Central North Carolina Council">Central North Carolina Council</option>
                          <option value="Chattahoochee Council">Chattahoochee Council</option>
                          <option value="Chehaw Council">Chehaw Council</object>
                          <option value="Coastal Carolina Council">Costal Carolina Council</option>
                          <option value="Coastal Georgia Council">Coastal Georgia Council</option>
                          <option value="Daniel Boone Council">Daniel Boone Council</option>
                          <option value="East Carolina Council">East Carolina Council</option>
                          <option value="Flint River Council">Flint River Council</object>
                          <option value="Georgia-Carolina Council">Georgia-Carolina Council</option>
                          <option value="Gulf Coast Council">Gulf Coast Council</option>
                          <option value="Gulf Ridge Council">Gulf Ridge Council</option>
                          <option value="Gulf Stream Council">Gulf Stream Council</option>
                          <option value="Indian Waters Council">Indian Waters Council</option>
                          <option value="Mecklenburg County Council">Mecklenburg Council</option>
                          <option value="North Florida Counicl">North Florida Council</option>
                          <option value="Northeast Georgia Council">Northeast Georgia Council</option>
                          <option value="Northwest Georgia Council">Northwest Georgia Council</option>
                          <option value="Occoneechee Council">Occoneechee Council</option>
                          <option value="Old Hickory Council">Old Hickory Council</option>
                          <option value="Palmetto Area Council">Palmetto Area Council</option>
                          <option value="Pee Dee Area Council">Pee Dee Area Council</option>
                          <option value="Piedmont Council">Piedmont Council</option>
                          <option value="South Florida Council">South Florida Council</option>
                          <option value="Southwest Florida Council">Southwest Florida Council</option>
                          <option value="Suwannee River Area Council">Suwannee River Area Council</option>
                          <option value="Tuscarora Council">Tuscarora Council</option>
                          <option value="West Central Florida Council">West Central Florida Council</option>
                          <option value="Out of Council">Other Council<
                        </select>
                        <br>
                        <label for="week">Week Attending Camp</label>
                        <select name="week" class="form-control" id="week">
                          <option value="1">Week 1</option>
                          <option value="2">Week 2</option>
                          <option value="3">Week 3</option>
                          <option value="4">Week 4</option>
                          <option value="5">Week 5</option>
                          <option value="6">Week 6</option>
                          <option value="8">Week 7</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-default">
                          <i class="fa fa-check"></i> Register Troop
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
