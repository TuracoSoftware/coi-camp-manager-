@extends('layouts.index')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Troop Profile
    </h1>
    <br>
  </section>
<section class="content">
  <div class="row">
    <div class="col-md-3">

      <div class="box box-primary">
        <div class="box-body box-profile">
          <h3 class="profile-username text-center">Troop {{ $troop->troop }}</h3>

          <p class="text-muted text-center">{{ $troop->council }}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Scoutmaster</b> <a class="pull-right">{{ $troop->scout_master_first_name }} {{ $troop->scout_master_last_name }}</a>
            </li>
            <li class="list-group-item">
              <b>Week</b> <a class="pull-right">{{ $troop->week_attending_camp }}</a>
            </li>
            <li class="list-group-item">
              <b>Phone</b> <a class="pull-right">{{ $troop->scout_master_phone }}</a>
            </li>
            <li class="list-group-item">
              <b>Email</b> <a class="pull-right">{{ $troop->scout_master_email }}</a>
            </li>
            <li class="list-group-item">
              <a href="{{ URL::to('troop/' . $troop->id . '/edit') }}" class="btn btn-primary btn-primary btn-block"><b>Edit Troop primaryrmation</b></a>
              <a href="{{ URL::to('scout/create') }}" class="btn btn-primary btn-primary btn-block"><b>New Scout</b></a>
            </li>
          </ul>
          <a href="{{ URL::to('troop/' . $troop->id . '/roster_print') }}" class="btn btn-primary btn-primary btn-block"><b>Print Troop Roster</b></a>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#scouts" data-toggle="tab">Scouts</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="scouts">
                <!-- Post -->
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
                        <a href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')" class="pull-right btn-box-tool"><i class="fa fa-times"></i><span> Delete Scout</span></a>
                    </span>
                  </div>
                  <!-- /.user-block -->


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
                      <td>2:00pm-5:00pm</td>
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
                <!-- /.post -->
                @endforeach
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
</section>
</div>
@endsection
