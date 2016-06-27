@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
    <h2>Week {{ $week }}</h2>
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
          <tbody>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                    <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                  </ul>
                </div>
              @else
                @if(!empty( $classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name ))
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Actions</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                      <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                    </ul>
                  </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
              @else
                @if(!empty( $classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name ))
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                    <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                  </ul>
                </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
              @else
                @if(!empty( $classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name ))
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                    <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                  </ul>
                </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
              @else
                @if(!empty( $classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name ))
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                    <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                  </ul>
                </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
              @else
                @if(!empty( $classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name ))
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Actions</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                    <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                  </ul>
                </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
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
              <div class="btn-group">
                <button type="button" class="btn btn-success">Actions</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ URL::to('staff/roster/'.$classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Roster</i></a></li>
                  <li><a href="{{ URL::to('staff/advancement/'.$classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->id.'/'.$week) }}" target="_blank"><i class="fa fa-print"> Advancement</i></a></li>
                </ul>
              </div>
              @endif
            </td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>
  </section>
</section>

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
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
