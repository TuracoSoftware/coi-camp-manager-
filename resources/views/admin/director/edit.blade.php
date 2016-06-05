@extends('layouts.index')

@section('content')
<div class="content-wrapper">
  <div class="content">
            <div class="panel panel-default">
                <div class="panel-heading">Director Editing</div>
                  <div class="panel-body">
                    <div class="form">
                      <form method="POST" action="{{ url('administrator/director/' . $id) }}" >
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
                        <label for"type">New type:</label>
                        <select name="type" class="form-control" id="type">
                          <option value="director">Director</option>
                          <option value="NULL">None</option>
                          <option value="admin">Admin</option>
                          <option value="staff">Staff</option>
                        </select>
                        <br>
                        <label for="description">New User's Desciption</label>
                        <input name="description" type="text" class="form-control" id="description">
                        <br>
                        <label for="department">New User's Department:</label>
                        <input name="department" type="text" class="form-control" id="department">
                        <br>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-save"></i>  Save
                        </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
