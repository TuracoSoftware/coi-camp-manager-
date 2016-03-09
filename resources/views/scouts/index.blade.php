@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


            <div class="row">

              <!-- New Scout button -->
              <div class="col-md-4">
                <div class="mar-12">
                  <a class="btn btn-small btn-info" href="{{ URL::to('scout/create') }}">
                    <i class="fa fa-plus-square-o"></i> New Scout
                  </a>
                </div>
              </div>

              <!-- Search form -->
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
              </div>
            </div>


            @foreach($scouts as $key => $scout)
              <div class="panel panel-default">
                <div class="panel-heading">
                  {{ $scout->lastname }}, {{ $scout->firstname }} - <strong>{{ $scout->age }} Years Old:</strong>
                  <div class="troop-buttons">
                    <a href="{{ URL::to('scout/' . $scout->id . '/schedule') }}"><i class="fa fa-edit"> Edit Schedule</i></a> |
                    <a href="{{ URL::to('scout-pint-view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"> Print Schedule</i></a> |
                    <a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"> Edit Scout</i></a> |
                    <a type="button" href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')">
                      <i class="fa fa-trash"> Delete Scout</i>
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
                      <td>9:00am-12:00pm</td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                         {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>2:000pm-5:00pm</td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name }}
                        @else
                            @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name ))
                              {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name }}
                            @else
                              Free
                            @endif
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name }}
                        @else
                          @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name ))
                            {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name }}
                          @else
                            Free
                          @endif
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name }}
                        @else
                          @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name ))
                            {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name }}
                          @else
                            Free
                          @endif
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name ))
                          {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name }}
                        @else
                          @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name ))
                            {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name }}
                          @else
                            Free
                          @endif
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name ))
                         {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name }}
                        @else
                          @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name ))
                            {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name }}
                          @else
                            Free
                          @endif
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>7:00pm-9:00pm</td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name ))
                          {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name ))
                          {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name ))
                          {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name ))
                          {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name ))
                         {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name }}
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
