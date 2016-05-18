@extends('admin.index')

@section('content')
<section class="content-wrapper">

  <section class="contenet-header">

    <h2 class="page-header">Create a Merit Badge</h2>
  </section>
  <section class="content">
    <div class="form">
      <form action="{{ URL::to('meritbadge') }}" method="POST">
        {!! csrf_field() !!}
        <label for="name">Merit Badge Name:</label>
        <input name="name" type="text" class="form-control" id="name"></input>
      </form>
    </section>
@endsection
