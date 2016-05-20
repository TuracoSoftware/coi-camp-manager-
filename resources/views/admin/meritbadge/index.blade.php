@extends('admin.index')

@section('content')
  <section class="content-wrapper">

    <section class="content-header">

      <h2 class="page-header">All Merit Badges</h2>

      <a class="btn btn-small btn-info" href="{{ URL::to('administrator/meritbadge/create') }}"
        <i class="fa fa-plus-square"></i> New MeritBadge
      </a>

    </section>

    <section class="content">
      <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#all_meritbadges" data-toggle="tab">All MeritBadges</a></li>
            <li><a href="#all_requirements" data-toggle="tab">All Requirements</a></li>
          </ul>
        </div>
      <div class="tab-content">
        <div class="tab-pane-active" id="all-meritbadges">
          <table id="meritbadge_table" class="table table-bordered table-hovered">
            <thead>
              <tr>
                <th>MeritBadge Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($meritbadges as $key => $meritbadge)
              <tr>
                <td>{{$meritbadges->meritbadge->name}}</td>
                <td>{{$meritbadges->meritbadge->description}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success">Actions</button>
                    <button type="button" class="btn btn-success dropdown-toggle"data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>"
                    </button>
                    <ul class="dropdown-menu"role="menu">
                      <li><a href="{{URL::to('meritbadge/' . $meritbadge->id . '/edit')}}">
                        <i class="fa fa-pencil-square-o"></i>Edit Merit Badge</a>
                      </li>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
      </div>
    </section>
  </section>

@endsection
