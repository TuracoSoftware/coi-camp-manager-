@extends('admin.index')

@section('content')

<section class="content-wrapper">
  <section class="content-header">
    <h2 class="page-header">Scoutmaster Sessions</h2>
    <a class="btn btn-small btn-info" href="{{ URL::to('administrator/scoutmastersession/create') }}">
      <i class="fa fa-plus-square-o"></i> New Session
   </a>
  </section>
</section>

@endsection
