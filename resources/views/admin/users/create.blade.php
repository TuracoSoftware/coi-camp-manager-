@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content">
    <div class="panel panel-default">
      <div class="panel-heading">New User</div>
      <div class="panel-body">
        <div class="form">
          <form action="{{ url('administrator/users') }}"  method="POST">
          {!! csrf_field() !!}
            <label for="name">Name:</label>
              <input name="name" type="text" class="form-control" id="name" required="required">
              @if($errors->first('firstname'))
                <span class="error">The user's name is required</span>
              @endif
            <br>
            <label for="email">Email:</label>
              <input name="email" type="text" class="form-control" id="email">
            <br>
            <label for"password">Password:</label>
              <input name="password" type="password" class="form-control" id="password">
            <br>
            <label for="type">Type:</label>
              <select name="type" class="form-control" id="type">
                <option value="NULL">None</option>
                <option value="admin">Admin</option>
                <option value="director">Director</option>
                <option value="staff">Staff</option>
              </select>
            <br>
            <button type="submit" class="btn btn-default">
              <i class="fa fa-check"></i> Register User
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</section>
@endsection
