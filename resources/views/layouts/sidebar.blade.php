<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset ("../resources/assets/img/camp2.jpg ") }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
      </div>
    </div>
    <br>
    @if(Auth::user()->type == 'admin')
      <ul class="sidebar-menu">
        <li class="header">Functions Sidebar</li>

        <li {!! Request::is('administrator') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>

        @if(Request::is('administrator/week/1') || Request::is('administrator/week/2') || Request::is('administrator/week/3') ||
            Request::is('administrator/week/4') || Request::is('administrator/week/5') ||
            Request::is('administrator/week/6') || Request::is('administrator/week/7'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-calendar-check-o"></i> <span>Registration</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('administrator/week/1') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/1') }}">Week 1</a></li>
              <li {!! Request::is('administrator/week/2') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/2') }}">Week 2</a></li>
              <li {!! Request::is('administrator/week/3') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/3') }}">Week 3</a></li>
              <li {!! Request::is('administrator/week/4') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/4') }}">Week 4</a></li>
              <li {!! Request::is('administrator/week/5') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/5') }}">Week 5</a></li>
              <li {!! Request::is('administrator/week/6') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/6') }}">Week 6</a></li>
              <li {!! Request::is('administrator/week/7') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/7') }}">Week 7</a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-calendar-check-o"></i> <span>Registration</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/administrator/week/1') }}">Week 1</a></li>
              <li><a href="{{ URL::to('/administrator/week/2') }}">Week 2</a></li>
              <li><a href="{{ URL::to('/administrator/week/3') }}">Week 3</a></li>
              <li><a href="{{ URL::to('/administrator/week/4') }}">Week 4</a></li>
              <li><a href="{{ URL::to('/administrator/week/5') }}">Week 5</a></li>
              <li><a href="{{ URL::to('/administrator/week/6') }}">Week 6</a></li>
              <li><a href="{{ URL::to('/administrator/week/7') }}">Week 7</a></li>
            </ul>
          </li>
        @endif

        <li {!! Request::is('troop') ? ' class="active"' : '' !!}>
          <a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>All Troops</span></a>
        </li>

        @if(Request::is('sclass') || Request::is('administrator/roster') || Request::is('administrator/meritbadge'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('sclass') ? ' class="active"' : '' !!}><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li {!! Request::is('administrator/meritbadge') ? ' class="active"' : '' !!}><a href="{{URL::to('/administrator/meritbadge')}}"><i class="fa fa-tasks"></i><span>Merit Badges</span></a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li><a href="{{ URL::to('/administrator/meritbadge') }}"><i class="fa fa-tasks"></i><span>Merit Badges</span></a></li>
            </ul>
          </li>
        @endif

        @if(Request::is('administrator/users') || Request::is('administrator/staff'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('administrator/users') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/users') }}"><i class="fa fa-mortar-board"></i> <span>Users</span></a></li>
              <li {!! Request::is('administrator/staff') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
              <li {!! Request::is('administrator/director') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/director') }}"><i class="fa fa-mortar-board"></i> <span>Directors</span></a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/administrator/users') }}"><i class="fa fa-mortar-board"></i> <span>Users</span></a></li>
              <li><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
              <li><a href="{{ URL::to('/administrator/director') }}"><i class="fa fa-mortar-board"></i> <span>Directors</span></a></li>
            </ul>
          </li>
        @endif
      </ul>

    @elseif(Auth::user()->type == 'staff')
      <ul class="sidebar-menu">
        <li class="header">Functions</li>

        @if(Request::is('staff/classes/1') || Request::is('staff/classes/2') || Request::is('staff/classes/3') ||
            Request::is('staff/classes/4') || Request::is('staff/classes/5') ||
            Request::is('staff/classes/6') || Request::is('staff/classes/7'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>Classes</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/staff/classes/1') }}"><i class="fa fa-mortar-board"></i> <span>Week 1</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/2') }}"><i class="fa fa-mortar-board"></i> <span>Week 2</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/3') }}"><i class="fa fa-mortar-board"></i> <span>Week 3</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/4') }}"><i class="fa fa-mortar-board"></i> <span>Week 4</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/5') }}"><i class="fa fa-mortar-board"></i> <span>Week 5</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/6') }}"><i class="fa fa-mortar-board"></i> <span>Week 6</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/7') }}"><i class="fa fa-mortar-board"></i> <span>Week 7</span></a></li>
            </ul>
          </li>
        @else
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>Classes</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/staff/classes/1') }}"><i class="fa fa-mortar-board"></i> <span>Week 1</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/2') }}"><i class="fa fa-mortar-board"></i> <span>Week 2</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/3') }}"><i class="fa fa-mortar-board"></i> <span>Week 3</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/4') }}"><i class="fa fa-mortar-board"></i> <span>Week 4</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/5') }}"><i class="fa fa-mortar-board"></i> <span>Week 5</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/6') }}"><i class="fa fa-mortar-board"></i> <span>Week 6</span></a></li>
              <li><a href="{{ URL::to('/staff/classes/7') }}"><i class="fa fa-mortar-board"></i> <span>Week 7</span></a></li>
            </ul>
          </li>
        @endif

        <li {!! Request::is('troop') ? ' class="active"' : '' !!}>
          <a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>All Troops</span></a>
        </li>

        @if(Request::is('sclass') || Request::is('administrator/staff'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('sclass') ? ' class="active"' : '' !!}><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li {!! Request::is('administrator/staff') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
            </ul>
          </li>
        @endif
      </ul>

    @elseif(Auth::user()->type == 'director')
      <ul class="sidebar-menu">
        <li class="header">Functions</li>
        <li {!! Request::is('director') ? ' class="active"' : '' !!}>
          <a href="{{ URL::to('/director') }}"><i class="fa fa-users"></i> <span>Home</span></a>
        </li>

        @if(Request::is('administrator/week/1') || Request::is('administrator/week/2') || Request::is('administrator/week/3') ||
            Request::is('administrator/week/4') || Request::is('administrator/week/5') ||
            Request::is('administrator/week/6') || Request::is('administrator/week/7'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-calendar-check-o"></i> <span>Registration</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('administrator/week/1') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/1') }}">Week 1</a></li>
              <li {!! Request::is('administrator/week/2') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/2') }}">Week 2</a></li>
              <li {!! Request::is('administrator/week/3') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/3') }}">Week 3</a></li>
              <li {!! Request::is('administrator/week/4') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/4') }}">Week 4</a></li>
              <li {!! Request::is('administrator/week/5') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/5') }}">Week 5</a></li>
              <li {!! Request::is('administrator/week/6') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/6') }}">Week 6</a></li>
              <li {!! Request::is('administrator/week/7') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/week/7') }}">Week 7</a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-calendar-check-o"></i> <span>Registration</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/administrator/week/1') }}">Week 1</a></li>
              <li><a href="{{ URL::to('/administrator/week/2') }}">Week 2</a></li>
              <li><a href="{{ URL::to('/administrator/week/3') }}">Week 3</a></li>
              <li><a href="{{ URL::to('/administrator/week/4') }}">Week 4</a></li>
              <li><a href="{{ URL::to('/administrator/week/5') }}">Week 5</a></li>
              <li><a href="{{ URL::to('/administrator/week/6') }}">Week 6</a></li>
              <li><a href="{{ URL::to('/administrator/week/7') }}">Week 7</a></li>
            </ul>
          </li>
        @endif

        <li {!! Request::is('troop') ? ' class="active"' : '' !!}>
          <a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>All Troops</span></a>
        </li>

        @if(Request::is('sclass') || Request::is('administrator/staff'))
          <li class="treeview active">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li {!! Request::is('sclass') ? ' class="active"' : '' !!}><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li {!! Request::is('administrator/staff') ? ' class="active"' : '' !!}><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
            </ul>
          </li>
        @else
          <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
              <li><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
            </ul>
          </li>
        @endif
      </ul>
    @endif
  </section>
</aside>
