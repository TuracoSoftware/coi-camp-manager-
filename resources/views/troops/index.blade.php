@extends('layouts.index')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Troop Profile
    </h1>
    <br>

    @if($notroop)
    <div class="mar-12">
      <a class="btn btn-small btn-success" href="{{ URL::to('troop/create') }}">
        <i class="fa fa-plus-square-o"></i> Register Troop
      </a>
    </div>
    @endif
  </section>
  <section class="content">
    <div class="row">
      @foreach($troops as $key=>$value)
        <div class="col-md-3">
          <div class="box box-success">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">Troop {{ $value->troop }}</h3>
              <p class="text-muted text-center">{{ $value->council }}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Scoutmaster</b>
                  <a class="pull-right">{{ $value->scout_master_first_name }} {{ $value->scout_master_last_name }}</a>
                </li>
                <li class="list-group-item">
                  <b>Week</b>
                  <a class="pull-right">{{ $value->week_attending_camp }}</a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b>
                  <a class="pull-right">{{ $value->scout_master_phone }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b>
                  <a class="pull-right">{{ $value->scout_master_email }}</a>
                </li>
                <li class="list-group-item">
                  <a href="{{ URL::to('troop/' . $value->id . '/edit') }}" class="btn btn-primary btn-success btn-block"><b>Edit Troop Information</b></a>
                  <a href="{{ URL::to('scout/create') }}" class="btn btn-primary btn-success btn-block"><b>New Scout</b></a>
                </li>
              </ul>
              <a href="{{ URL::to('troop/' . $value->id . '/roster_print') }}" class="btn btn-primary btn-success btn-block"><b>Print Troop Roster</b></a>
            </div>
          </div>
        </div>
      @endforeach
      @if(!$notroop)
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#scouts" data-toggle="tab">Scouts</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="scouts">
                @foreach($scouts as $key=>$scout)
                  <div class="post">
                    <div class="user-block">
                      <span class="username">
                        <a href="#">{{ $scout->lastname }}, {{ $scout->firstname }} - <strong>{{ $scout->age }} Years Old</strong></a>
                      </span>
                      <span class="description">
                        <p>Scout proflie created at {{ $scout->created_at }}</p>
                        <a href="{{ URL::to('scout/' . $scout->id . '/schedule') }}"><i class="fa fa-edit"></i><span> Edit Schedule</span></a> |
                        <a href="{{ URL::to('scout_print_view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"></i><span> Print Schedule</span></a> |
                        <a href="{{ URL::to('scout_advancement_print/'.$scout->id) }}" target="_blank"><i class="fa fa-print"></i><span> Print Advancement</span></a> |
                        <a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"></i><span> Edit Scout</span></a> |
                        <a href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')" class="btn-box-tool"><i class="fa fa-times"></i><span> Delete Scout</span></a>
                      </span>
                    </div>
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
                            Family Night
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
                            Campfire
                          @endif
                        </td>
                      </tr>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>
</div>
@endsection
