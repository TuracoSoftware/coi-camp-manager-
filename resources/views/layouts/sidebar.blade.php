<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
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
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Functions</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="{{ URL::to('/administrator')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
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
      <li><a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>Troops</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
          <li class="active"><a href="{{ URL::to('/administrator/users') }}"><i class="fa fa-mortar-board"></i> <span>Users</span></a></li>
          <li class="active"><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
          <li class="active"><a href="{{URL::to('/administrator/meritbadge')}}"><i class="fa fa-tasks"></i><span>Merit Badges</span></a></li>
        </ul>
      </li>
    </ul>
    @elseif(Auth::user()->type == 'staff')
    <ul class="sidebar-menu">
      <li class="header">Functions</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="{{ URL::to('/administrator')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li><a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>Troops</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
          <li class="active"><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Schedule</span></a></li>
        </ul>
      </li>
    </ul><!-- /.sidebar-menu -->
  </section>
    @elseif(Auth::user()->type == 'director')
    <ul class="sidebar-menu">
      <li class="header">Functions</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="{{ URL::to('/administrator')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
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
      <li><a href="{{ URL::to('/troop') }}"><i class="fa fa-users"></i> <span>Troops</span></a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ URL::to('/sclass') }}"><i class="fa fa-mortar-board"></i> <span>Classes</span></a></li>
          <li class="active"><a href="{{ URL::to('/administrator/staff') }}"><i class="fa fa-mortar-board"></i> <span>Staff</span></a></li>
        </ul>
      </li>
    </ul>
    @endif
  <!-- /.sidebar -->
</aside>
