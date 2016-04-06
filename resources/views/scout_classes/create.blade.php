@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <form>
                    <!--TODO:Load Scouts assosiated with the current user-->
                    <label for="scout">Select a Scout:</label>
                      <select name ="scout" class="form-control" id="scout">
                        <option value="<Select a Scout>">TODO: List of Scouts assosiated with user</option>
                      </select>
                      <br>
                      <!--TODO:Load Classes That are available this day. Classes for each day
                    assigned from the admin panel. If a class/session is AM only, show and addtional option
                    to add a PM class. Some classes are also age restricted- need to validate that somehow -->
                    <label for="monday">Monday Session:</label>
                    <select name ="monday" class="form-control" id="monday">
                      <option value="monday">(Moday Sessions Listed Here)</option>
                    </select>
                    <br>
                    <!--TODO:Load Classes That are available this day. Classes for each day
                  assigned from the admin panel-->
                    <label for="tuesday">Tuesday Session:</label>
                    <select name="tuesday" class="form-control" id="tuesday">
                      <option value="tuesday">(Tuesday Session Listed Here)</option>
                    </select>
                    <br>
                    <!--TODO:Load Classes That are available this day. Classes for each day
                  assigned from the admin panel-->
                    <label for="wednesday">Wednesday Session:</label>
                    <select name="wednesday" class="form-control" id="wednesday">
                      <option value="wednesday">(Wednesday Session)</option>
                    </select>
                    <br>
                    <!--TODO:Load Classes That are available this day. Classes for each day
                  assigned from the admin panel-->
                    <label for="thursday">Thursday Session:</label>
                    <select name="thurseday" class="form-control" id="thurseday">
                      <option value="thurday">(Thruseday Session)</option>
                    </select>
                    <br>
                    <!--TODO:Load Classes That are available this day. Classes for each day
                  assigned from the admin panel-->
                    <label for"friday">Friday Session:</label>
                    <select name="friday" class="form-control" id="friday">
                      <option value="friday">(Friday Session)</option>
                    </select>
                    <br>
                    <input type="submit" value="Submit"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
