@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  </section>
  <br>
  <section class="content">
    <div class="panel panel-default">
      <div class="panel-heading">Your Classes</div>
      <div class="panel-body">
        <table class="table table-hover" id="staff_table">
          <thead>
            <tr>
              <td>Time</td>
              <td>Monday</td>
              <td>Actions</td>
              <td>Tuedsay</td>
              <td>Actions</td>
              <td>Wednesday</td>
              <td>Actions</td>
              <td>Thursday</td>
              <td>Actions</td>
              <td>Friday</td>
              <td>Actions</td>
            </tr>
          </thead>
          <tr>
            <td>9:00am-12:00pm</td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
               {{ $classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
          </tr>
          <tr>
            <td>2:00pm-5:00pm</td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name }}
              @elseif(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name ))
                {{ $classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name ))
                <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}">
                  <i class="fa fa-users"></i> Roster
                </a>
              @else
                @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name ))
                  <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}">
                    <i class="fa fa-users"></i> Roster
                  </a>
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name }}
              @else
                @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name ))
                  {{ $classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name }}
                @else
                  Free
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @else
                @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name ))
                <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}">
                  <i class="fa fa-users"></i> Roster
                </a>
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name }}
              @else
                @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name ))
                  {{ $classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name }}
                @else
                  Free
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @else
                @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name ))
                <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}">
                  <i class="fa fa-users"></i> Roster
                </a>
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name ))
                {{ $classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name }}
              @else
                @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name ))
                  {{ $classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name }}
                @else
                  Free
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @else
                @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name ))
                <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}">
                  <i class="fa fa-users"></i> Roster
                </a>
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name ))
               {{ $classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name }}
              @else
                @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name ))
                  {{ $classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name }}
                @else
                  Free
                @endif
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @else
                @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name ))
                <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}">
                  <i class="fa fa-users"></i> Roster
                </a>
                @endif
              @endif
            </td>
          </tr>
          <tr>
            <td>7:00pm-9:00pm</td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name ))
                {{ $classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name ))
                {{ $classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name ))
                {{ $classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name }}
              @else
                Family Night
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name ))
                {{ $classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name }}
              @else
                Free
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name ))
               {{ $classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name }}
              @else
                Campfire
              @endif
            </td>
            <td>
              @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name ))
              <a class="btn btn-small btn-info" href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}">
                <i class="fa fa-users"></i> Roster
              </a>
              @endif
            </td>
          </tr>
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
    $('#staff_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
