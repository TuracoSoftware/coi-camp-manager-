<header class="main-header">
  @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff')
    <a href="{{ url('/') }}" class="logo">
      <span class="logo-mini"><b>COI</b></span>
      <span class="logo-lg"><b>Camp Old Indian</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  @else
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          @if(Request::is('troop'))
            <a href="#" class="navbar-brand"><b>Camp Old Indian</b></a>
          @else
            <a href="../troop" class="navbar-brand"><b>Camp Old Indian</b></a>
          @endif
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  @endif
</header>
