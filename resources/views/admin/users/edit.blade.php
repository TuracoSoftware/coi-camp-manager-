@extends('admin.index')

@section('content')
<div class="container">
    <br>
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User Editing</div>
                  <div class="panel-body">
                    <div class="form">
                      <form method="POST" action="{{ url('administrator/users/' . $id) }}" >
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT">
                        <label for="name">New User's Name:</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <br>
                        <label for="email">New User's Email:</label>
                        <input name="email" type="text" class="form-control" id="email">
                        <br>
                        <label for"new_password">New Password:</label>
                        <input name="new_password" type="text" class="form-control" id="new_password">
                        <br>
                        <label for"confirm_password">Confirm New Password:</label>
                        <input name="confirm_password" type="text" class="form-control" id="confirm_password">
                        <br>
                        <select name="type" class="form-control" id="type">
                          <option value="NULL">None</option>
                          <option value="admin">Admin</option>
                          <option value="staff">Staff</option>
                        </select>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-save"></i>  Save
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection