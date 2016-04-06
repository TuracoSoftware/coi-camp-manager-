@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Scout Schedule Editing</div>

        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scout/'.$scout->id.'/schedule') }}" method="POST">
              {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">

              <div class="panel panel-default">
                <div class="panel-heading">
                  {{ $scout->lastname }}, {{ $scout->firstname }} - <strong>{{ $scout->age }} Years Old:</strong>
                  <a href="{{ URL::to('#') }}"><i class="fa fa-print"></i><span> Print Schedule</span></a> |
                  <a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"></i><span> Edit Scout</span></a>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td>Time</td>
                        <td>Monday</td>
                        <td>Tuedsay</td>
                        <td>Wednesday</td>
                        <td>Thursday</td>
                        <td>Friday</td>
                      </tr>
                    </thead>
                    <tr>
                      <td>9:00am-12:00pm</td>
                      <td>
                        <select name="mo912" class ="form-control" id="mo912">
                          <option value="Free">Free</option>
                          @foreach($sclasses_mo912 as $key => $sclass_mo912)
                            @if(!empty($mo912))
                              @if($sclass_mo912->name == $mo912)

                                <option value="{{ $sclass_mo912->id }}" selected>{{ $sclass_mo912->name }}</option>
                              @else
                                <option value="{{ $sclass_mo912->id }}">{{ $sclass_mo912->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_mo912->id }}">{{ $sclass_mo912->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="tu912" class ="form-control" id="tu912">
                          <option value="Free">Free</option>
                          @foreach($sclasses_tu912 as $key => $sclass_tu912)
                            @if(!empty($tu912))
                              @if($sclass_tu912->name == $tu912)
                                <option value="{{ $sclass_tu912->id }}" selected>{{ $sclass_tu912->name }}</option>
                              @else
                                <option value="{{ $sclass_tu912->id }}">{{ $sclass_tu912->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_tu912->id }}">{{ $sclass_tu912->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="we912" class ="form-control" id="we912">
                          <option value="Free">Free</option>
                          @foreach($sclasses_we912 as $key => $sclass_we912)
                            @if(!empty($we912))
                              @if($sclass_we912->name == $we912)
                                <option value="{{ $sclass_we912->id }}" selected>{{ $sclass_we912->name }}</option>
                              @else
                                <option value="{{ $sclass_we912->id }}">{{ $sclass_we912->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_we912->id }}">{{ $sclass_we912->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="th912" class ="form-control" id="th912">
                          <option value="Free">Free</option>
                          @foreach($sclasses_th912 as $key => $sclass_th912)
                            @if(!empty($th912))
                              @if($sclass_th912->name == $th912)
                                <option value="{{ $sclass_th912->id }}" selected>{{ $sclass_th912->name }}</option>
                              @else
                                <option value="{{ $sclass_th912->id }}">{{ $sclass_th912->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_th912->id }}">{{ $sclass_th912->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="fr912" class ="form-control" id="fr912">
                          <option value="Free">Free</option>
                          @foreach($sclasses_fr912 as $key => $sclass_fr912)
                            @if(!empty($fr912))
                              @if($sclass_fr912->name == $fr912)
                                <option value="{{ $sclass_fr912->id }}" selected>{{ $sclass_fr912->name }}</option>
                              @else
                                <option value="{{ $sclass_fr912->id }}">{{ $sclass_fr912->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_fr912->id }}">{{ $sclass_fr912->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>2:00pm-5:00pm</td>
                      <td>
                        <select name="mo25" class ="form-control" id="mo25">
                          <option value="Free">Free</option>
                          @foreach($sclasses_mo25 as $key => $sclass_mo25)
                            @if(!empty($mo25))
                              @if($sclass_mo25->name == $mo25)
                                <option value="{{ $sclass_mo25->id }}" selected>{{ $sclass_mo25->name }}</option>
                              @else
                                <option value="{{ $sclass_mo25->id }}">{{ $sclass_mo25->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_mo25->id }}">{{ $sclass_mo25->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="tu25" class ="form-control" id="tu25">
                          <option value="Free">Free</option>
                          @foreach($sclasses_tu25 as $key => $sclass_tu25)
                            @if(!empty($tu25))
                              @if($sclass_tu25->name == $tu25)
                                <option value="{{ $sclass_tu25->id }}" selected>{{ $sclass_tu25->name }}</option>
                              @else
                                <option value="{{ $sclass_tu25->id }}">{{ $sclass_tu25->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_tu25->id }}">{{ $sclass_tu25->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="we25" class ="form-control" id="we25">
                          <option value="Free">Free</option>
                          @foreach($sclasses_we25 as $key => $sclass_we25)
                            @if(!empty($we25))
                              @if($sclass_we25->name == $we25)
                                <option value="{{ $sclass_we25->id }}" selected>{{ $sclass_we25->name }}</option>
                              @else
                                <option value="{{ $sclass_we25->id }}">{{ $sclass_we25->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_we25->id }}">{{ $sclass_we25->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="th25" class ="form-control" id="th25">
                          <option value="Free">Free</option>
                          @foreach($sclasses_th25 as $key => $sclass_th25)
                            @if(!empty($th25))
                              @if($sclass_th25->name == $th25)
                                <option value="{{ $sclass_th25->id }}" selected>{{ $sclass_th25->name }}</option>
                              @else
                                <option value="{{ $sclass_th25->id }}">{{ $sclass_th25->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_th25->id }}">{{ $sclass_th25->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="fr25" class ="form-control" id="fr25">
                          <option value="Free">Free</option>
                          @foreach($sclasses_fr25 as $key => $sclass_fr25)
                            @if(!empty($fr25))
                              @if($sclass_fr25->name == $fr25)
                                <option value="{{ $sclass_fr25->id }}" selected>{{ $sclass_fr25->name }}</option>
                              @else
                                <option value="{{ $sclass_fr25->id }}">{{ $sclass_fr25->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_fr25->id }}">{{ $sclass_fr25->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>7:00pm-9:00pm</td>
                      <td>
                        <select name="mo79" class ="form-control" id="mo79">
                          <option value="Free">Free</option>
                          @foreach($sclasses_mo79 as $key => $sclass_mo79)
                            @if(!empty($mo79))
                              @if($sclass_mo79->name == $mo79)
                                <option value="{{ $sclass_mo79->id }}" selected>{{ $sclass_mo79->name }}</option>
                              @else
                                <option value="{{ $sclass_mo79->id }}">{{ $sclass_mo79->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_mo79->id }}">{{ $sclass_mo79->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="tu79" class ="form-control" id="tu79">
                          <option value="Free">Free</option>
                          @foreach($sclasses_tu79 as $key => $sclass_tu79)
                            @if(!empty($tu79))
                              @if($sclass_tu79->name == $tu79)
                                <option value="{{ $sclass_tu79->id }}" selected>{{ $sclass_tu79->name }}</option>
                              @else
                                <option value="{{ $sclass_tu79->id }}">{{ $sclass_tu79->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_tu79->id }}">{{ $sclass_tu79->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="we79" class ="form-control" id="we79">
                          <option value="Free">Free</option>
                          @foreach($sclasses_we79 as $key => $sclass_we79)
                            @if(!empty($we79))
                              @if($sclass_we79->name == $we79)
                                <option value="{{ $sclass_we79->id }}" selected>{{ $sclass_we79->name }}</option>
                              @else
                                <option value="{{ $sclass_we79->id }}">{{ $sclass_we79->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_we79->id }}">{{ $sclass_we79->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="th79" class ="form-control" id="th79">
                          <option value="Free">Free</option>
                          @foreach($sclasses_th79 as $key => $sclass_th79)
                            @if(!empty($th79))
                              @if($sclass_th79->name == $th79)
                                <option value="{{ $sclass_th79->id }}" selected>{{ $sclass_th79->name }}</option>
                              @else
                                <option value="{{ $sclass_th79->id }}">{{ $sclass_th79->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_th79->id }}">{{ $sclass_th79->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="fr79" class ="form-control" id="fr79">
                          <option value="Free">Free</option>
                          @foreach($sclasses_fr79 as $key => $sclass_fr79)
                            @if(!empty($fr79))
                              @if($sclass_fr79->name == $fr79)
                                <option value="{{ $sclass_fr79->id }}" selected>{{ $sclass_fr79->name }}</option>
                              @else
                                <option value="{{ $sclass_fr79->id }}">{{ $sclass_fr79->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_fr79->id }}">{{ $sclass_fr79->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <br><input class="btn btn-default" type="submit" value="Submit">
            </form>

            <div class="ampm_classes hidden">

            <!-- ampm classes that start on monday -->
            @foreach($sclasses_mo912 as $key => $sclass_mo912)
              @if($sclass_mo912->duration == 'AM & PM')
                <input class="hidden monday" value="{{ $sclass_mo912->id }}" >
              @endif
            @endforeach

            @foreach($sclasses_tu912 as $key => $sclass_tu912)
              @if($sclass_tu912->duration == 'AM & PM')
                <input class="hidden tuesday" value="{{ $sclass_tu912->id }}" >
              @endif
            @endforeach

            @foreach($sclasses_we912 as $key => $sclass_we912)
              @if($sclass_we912->duration == 'AM & PM')
                <input class="hidden wednesday" value="{{ $sclass_we912->id }}" >
              @endif
            @endforeach

            @foreach($sclasses_th912 as $key => $sclass_th912)
              @if($sclass_th912->duration == 'AM & PM')
                <input class="hidden thursday" value="{{ $sclass_th912->id }}" >
              @endif
            @endforeach

            @foreach($sclasses_fr912 as $key => $sclass_fr912)
              @if($sclass_fr912->duration == 'AM & PM')
                <input class="hidden friday" value="{{ $sclass_fr912->id }}" >
              @endif
            @endforeach

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ~7Div0w2 -->
@endsection


@section('custom_scripts')
  <script src="{{ URL::asset('../resources/assets/js/scouts.js') }}"></script>
@stop
