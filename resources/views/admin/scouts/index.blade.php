@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
    <h2 class="page-header">Week {{ $week }}</h2>
    <!-- New Scout button -->
    @if(Auth::user()->type == 'admin')
      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/scout/create') }}">
        <i class="fa fa-plus-square-o"></i> New Scout
      </a>
      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/scout/all_schedule/'.$week) }}">
        <i class="fa fa-plus-square-o"></i> Print All Schedules
      </a>
    @elseif(Auth::user()->type == 'director')
      <a class="btn btn-small bg-purple" href="{{ URL::to('administrator/scout/create') }}">
        <i class="fa fa-plus-square-o"></i> New Scout
      </a>
    @endif
     <!-- Roster print dropdown menu -->
    <div class="btn-group">
      <button type="button" class="btn btn-success">Roster Print</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="{{ URL::to('administrator/AllRosters/' . $week . '/Monday') }}" target="_blank"><i class="fa fa-print"> Monday's Rosters</i></a></li>
        <li><a href="{{ URL::to('administrator/AllRosters/' . $week . '/Tuesday') }}" target="_blank"><i class="fa fa-print"> Tueday's Rosters</i></a></li>
        <li><a href="{{ URL::to('administrator/AllRosters/' . $week . '/Wednesday') }}" target="_blank"><i class="fa fa-print"> Wednesday's Rosters</i></a></li>
        <li><a href="{{ URL::to('administrator/AllRosters/' . $week . '/Thursday') }}" target="_blank"><i class="fa fa-print"> Thursday's Rosters</i></a></li>
        <li><a href="{{ URL::to('administrator/AllRosters/' . $week . '/Friday') }}" target="_blank"><i class="fa fa-print"> Friday's Rosters</i></a></li>
      </ul>
    </div>
  </section>

  <section class="content">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#all_scouts" data-toggle="tab">All Scouts</a></li>
        <li><a href="#all_troops" data-toggle="tab">All Troops</a></li>
        <li><a href="#all_classes" data-toggle="tab">All Classes</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="all_scouts">
          <table id="scout_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Troop</th>
                <th>Council</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Age</th>
                <th>Schedule<th>
              </tr>
            </thead>
            <tbody>
              @foreach($scouts as $key => $scout)
              <tr>
                <td>{{ $scout->troop->troop }}</td>
                <td>{{ $scout->troop->council }}</td>
                <td>{{ $scout->lastname }}</td>
                <td>{{ $scout->firstname }}</td>
                <td>{{ $scout->age }}</td>
                <td>
                  <table class="table">
                    <thead>
                      <tr>
                        <td>Monday</td>
                        <td>Tuedsay</td>
                        <td>Wednesday</td>
                        <td>Thursday</td>
                        <td>Friday</td>
                      </tr>
                    </thead>
                    <tr>
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
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Actions</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{ URL::to('scout/' . $scout->id . '/schedule') }}"><i class="fa fa-edit"> Edit Schedule</i></a></li>
                      <li><a href="{{ URL::to('scout_print_view/'.$scout->id) }}" target="_blank"><i class="fa fa-print"> Print Schedule</i></a></li>
                      <li><a href="{{ URL::to('scout/' . $scout->id . '/edit') }}"><i class="fa fa-user"> Edit Scout</i></a></li>
                      @if(Auth::user()->type == 'admin')
                        <li class="divider"></li>
                        <li><a href="#" onclick="open_modal('Are you sure?', '{{ url('scout/'.$scout->id) }}', true, 'DELETE')">
                          <i class="fa fa-trash"> Delete Scout</i>
                        </a></li>
                      @endif
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="all_troops">
        <table id="troop_table" class="table table-bordered table-hover">
          <thead>
            <th>Troop</th>
            <th>Council</th>
            <th>Scoutmaster Name</th>
            <th>Scoutmaster Phone</th>
            <th>Scoutmaster Email</th>
            <th>Profile</th>
          </thead>
          <tbody>
            @foreach($troops as $key => $troop)
              <tr>
                <td>{{ $troop->troop }}</td>
                <td>{{ $troop->council }}</td>
                <td>{{ $troop->scout_master_last_name }}, {{ $troop->scout_master_first_name }}</td>
                <td>{{ $troop->scout_master_phone }}</td>
                <td>{{ $troop->scout_master_email }}</td>
                <td><a class="btn btn-small btn-info" href="{{ URL::to('administrator/troop/profile/'.$troop->id) }}">
                  <i class="fa fa-plus-o"></i> Troop Profile
                </a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="all_classes">
        <table id="classes_table" class="table table-bordered table-hover">
          <thead>
            <th>Day</th>
            <th>Class/Session</th>
            <th>Number Registred</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach($classes as $key => $class)
              <tr>
                <td>{{ $class->day }}</td>
                <td>{{ $class->name }}</td>
                <td>{{ $class->count_scouts_week($week) }}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Actions</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{ URL::to('roster_print_view/' . $class->id . '/' . $week) }}"><i class="fa fa-print">Print Roster</i></a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</section>
<!-- Scripts Required for DataTable -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset ("../resources/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
<!-- DataTables -->
<script src="{{ asset ("../resources/assets/admin/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset ("../resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset ("../resources/assets/admin/plugins/fastclick/fastclick.js") }}"></script>

<script>
  $(function () {
    $('#scout_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#troop_table').DataTable({
      "paging":true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#classes_table').DataTable({
      "paging":true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
