@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Scout Schedule Editing</div>
        <div class="panel-body">
          <div class="form">
            <form action="{{ url('scoutmaster/'.$scoutmaster->id.'/schedule') }}" method="POST">
              {!! csrf_field() !!}
              <input name="_method" type="hidden" value="PUT">
              <div class="panel panel-default">
                <div class="panel-heading">
                  {{ $scoutmaster->lastname }}, {{ $scoutmaster->firstname }}
                  <a href="{{ URL::to('#') }}"><i class="fa fa-print"></i><span> Print Schedule</span></a> |
                  <a href="{{ URL::to('scoutmaster/' . $scoutmaster->id . '/edit') }}"><i class="fa fa-user"></i><span> Edit Scout</span></a>
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
                      <td>Select a Session</td>
                      <td>
                        <select name="monday" class ="form-control" id="monday">
                          <option value="Free">Free</option>
                          @foreach($scoutmastersessions_monday as $key => $sclass_mo)
                            @if(!empty($mo912))
                              @if($sclass_mo->name == $mo912)
                                <option value="{{ $sclass_mo->id }}" selected>{{ $sclass_mo->name }}</option>
                              @else
                                <option value="{{ $sclass_mo->id }}">{{ $sclass_mo->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_mo->id }}">{{ $sclass_mo->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="tuesday" class ="form-control" id="tu912">
                          <option value="Free">Free</option>
                          @foreach($scoutmastersessions_tuesday as $key => $sclasses_tu)
                            @if(!empty($tu912))
                              @if($sclass_tu->name == $tu912)
                                <option value="{{ $sclass_tu->id }}" selected>{{ $sclass_tu->name }}</option>
                              @else
                                <option value="{{ $sclass_tu->id }}">{{ $sclass_tu->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_tu->id }}">{{ $sclass_tu->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="wednesday" class ="form-control" id="we912">
                          <option value="Free">Free</option>
                          @foreach($scoutmastersessions_wednesday as $key => $sclass_we)
                            @if(!empty($we912))
                              @if($sclass_we->name == $we912)
                                <option value="{{ $sclass_we->id }}" selected>{{ $sclass_we->name }}</option>
                              @else
                                <option value="{{ $sclass_we->id }}">{{ $sclass_we->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_we->id }}">{{ $sclass_we->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="thurseday" class ="form-control" id="th912">
                          <option value="Free">Free</option>
                          @foreach($scoutmastersessions_thurseday as $key => $sclass_th)
                            @if(!empty($th912))
                              @if($sclass_th->name == $th912)
                                <option value="{{ $sclass_th->id }}" selected>{{ $sclass_th->name }}</option>
                              @else
                                <option value="{{ $sclass_th->id }}">{{ $sclass_th->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_th->id }}">{{ $sclass_th->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <select name="friday" class ="form-control" id="fr912">
                          <option value="Free">Free</option>
                          @foreach($scoutmastersessions_friday as $key => $sclass_fr9)
                            @if(!empty($fr912))
                              @if($sclass_fr->name == $fr)
                                <option value="{{ $sclass_fr->id }}" selected>{{ $sclass_fr->name }}</option>
                              @else
                                <option value="{{ $sclass_fr->id }}">{{ $sclass_fr->name }}</option>
                              @endif
                            @else
                                <option value="{{ $sclass_fr->id }}">{{ $sclass_fr->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <br>
              <input class="btn btn-default" type="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_scripts')
  <script src="{{ URL::asset('../resources/assets/js/scouts.js') }}"></script>
@stop
