@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($scouts as $key => $scout)
              <div class="panel panel-default">
                <div class="panel-heading">
                  {{ $scout->lastname }}, {{$ scout->firstname }} - <strong>{{ $scout->age }} Years Old:</strong>
                  <a href="{{ URL::to('#') }}"><i class="fa fa-edit"> Edit Schedule</i></a> |
                  <a href="{{ URL::to('#') }}"><i class="fa fa-print"> Print Schedule</i></a> |
                  <a href="{{ URL::to('#') }}"><i class="fa fa-user"> Edit Scout</i></a>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td>Time</td>
                        <td>Monday</td>
                        <td>Tuedsay</td>
                        <td>Wednesday</td>
                        <td>Thurseday</td>
                        <td>Friday</td>
                      </tr>
                    </thead>
                    <tr>
                      <td>9:00am-12:00pm</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                    </tr>
                    <tr>
                      <td>2:000pm-5:00pm</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                    </tr>
                    <tr>
                      <td>7:00pm-9:00pm</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                      <td>{{  }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            @endforeach
            <div class="panel panel-default">
                <div class="panel-heading">
                    Camper, Johny - <strong>16 Years Old:</strong>
                    <a href="{{ URL::to('#') }}"><i class="fa fa-edit"> Edit Schedule</i></a> |
                    <a href="{{ URL::to('#') }}"><i class="fa fa-print"> Print Schedule</i></a> |
                    <a href="{{ URL::to('#') }}"><i class="fa fa-user"> Edit Scout</i></a>
                  </div>
                  <div class="panel-body">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <td>Time</td>
                            <td>Monday</td>
                            <td>Tuedsay</td>
                            <td>Wednesday</td>
                            <td>Thurseday</td>
                            <td>Friday</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>9:00am-12:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                          <tr>
                            <td>2:000pm-5:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                          <tr>
                            <td>7:00pm-9:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Wilcox, Dylan - <string>17 Years Old</strong>
                  <a href="{{ URL::to('#') }}"><i class="fa fa-edit"> Edit Schedule</i></a> |
                  <a href="{{ URL::to('#') }}"><i class="fa fa-print"> Print Schedule</i></a> |
                  <a href="{{ URL::to('#') }}"><i class="fa fa-user"> Edit Scout</i></a>
                </div>
                  <div class="panel-body">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <td>Time</td>
                            <td>Monday</td>
                            <td>Tuedsay</td>
                            <td>Wednesday</td>
                            <td>Thurseday</td>
                            <td>Friday</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>9:00am-12:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                          <tr>
                            <td>2:000pm-5:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                          <tr>
                            <td>7:00pm-9:00pm</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                            <td>Free</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
