@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


            <div class="row">

              <!-- New Scout button -->
              <div class="col-md-4">
                <div class="mar-12">
                  <a class="btn btn-small btn-info" href="{{ URL::to('scoutmaster/create') }}">
                    <i class="fa fa-plus-square-o"></i> New Scoutmaster
                  </a>
                </div>
              </div>

              <!-- Search form
              <div class="col-md-8">
                <div class="mar-12">
                  <form class="navbar-form" role="search" action="{{ URL::to('scout/search') }}" method="POST">
                    <div class="input-group">
                        {!! csrf_field() !!}
                        <input type="text" class="form-control" placeholder="Search a Scout" name="name">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                  </form>
                </div>
              </div> -->
            </div>

            @foreach($scoutmasters as $key => $scoutmaster)
              <div class="panel panel-default">
                <div class="panel-heading">
                  {{ $scoutmaster->lastname }}, {{ $scoutmaster->firstname }}</strong>
                  <div class="troop-buttons">
                    <a href="{{ URL::to('scoutmaster/' . $scoutmaster->id . '/schedule') }}"><i class="fa fa-edit"></i><span> Edit Schedule</span></a> |
                    <a href="{{ URL::to('scoutmaster_print_view/'.$scoutmaster->id) }}" target="_blank"><i class="fa fa-print"></i><span> Print Schedule</span></a> |
                    <a href="{{ URL::to('scoutmaster/' . $scoutmaster->id . '/edit') }}"><i class="fa fa-user"></i><span> Edit Scout</span></a> |
                    <a type="button" href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scoutmaster->id) }}', true, 'DELETE')">
                      <i class="fa fa-trash"></i><span> Delete Scout</span>
                    </a>
                  </div>
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
                      <td>Session</td>
                      <td>
                        @if(!empty( $scoutmaster->classes->where('day', 'Monday') ))
                          {{ $scoutmaster->classes->where('day', 'Monday') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scoutmaster->classes->where('day', 'Monday') ))
                          {{ $scoutmaster->classes->where('day', 'Monday') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scoutmaster->classes->where('day', 'Monday') ))
                          {{ $scoutmaster->classes->where('day', 'Monday') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scoutmaster->classes->where('day', 'Monday') ))
                          {{ $scoutmaster->classes->where('day', 'Monday') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scoutmaster->classes->where('day', 'Monday') ))
                          {{ $scoutmaster->classes->where('day', 'Monday') }}
                        @else
                          Free
                        @endif
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
