@extends('layouts.index')

@section('content')
<section class="content-wrapper">

            <section class="content-header">

            </section>
            <br>
            <div class="content">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $class->name }}</div>

                <div class="panel-body">
                  <form action="{{ url('staff/advancement/input') }}" method="POST">
                    {!! csrf_field() !!}
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td>Scout Name</td>
                        @foreach($requirements as $key=>$val)
                          <td>{{ $val->title_req }}</td>
                        @endforeach
                      </tr>
                    </thead>
                    <input name="meritB" value={{ $meritB->id }} type="hidden">
                    <input name="class" value={{ $class->id }} type="hidden">

                    @foreach($scouts as $key=>$scout)
                    <tr>
                      <td>{{ $scout->firstname }} {{ $scout->lastname }}</td>
                      @foreach($requirements as $key=>$val)
                      <td>
                      <div class="checkbox">
                        <label>
                          <input name="name" type="checkbox">
                        </label>
                      </div>
                    </td>
                        <!--<td><input name=<?php //echo "scout".strval($scout->id)."req".strval($val->id)?> type="checkbox" value=1></td>-->
                      @endforeach
                    </tr>
                    @endforeach

                  </table>
                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-check"></i> Submit
                  </button>
                </form>
            </div>
          </div>
  </section>
  @endsection
