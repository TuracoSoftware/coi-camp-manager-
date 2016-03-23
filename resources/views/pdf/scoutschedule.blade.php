<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $scout->lastname }}, {{ $scout->firstname }}</title>

    <link rel="stylesheet" href="{{ URL::asset('../resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('../resources/assets/css/style.css') }}">
  </head>
  <body>

                <h1>{{ $scout->lastname }}, {{ $scout->firstname }}</h1><br>
                <!--
                <h4>Total fee due at camp: {{ $earnings }} $</h4>
              -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <strong>{{ $scout->age }} Years Old</strong> -  @if(!empty($scout->troop)) Troop {{ $scout->troop->troop }} @endif
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuedsay</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          9:00am-12:00pm
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name ))
                           {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM Only', 'AM & PM'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td>2:000pm-5:00pm</td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['AM & PM'])->first()->name }}
                          @else
                              @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name ))
                                {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['PM Only'])->first()->name }}
                              @else
                                Free
                              @endif
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['AM & PM'])->first()->name }}
                          @else
                            @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name ))
                              {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['PM Only'])->first()->name }}
                            @else
                              Free
                            @endif
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['AM & PM'])->first()->name }}
                          @else
                            @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name ))
                              {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['PM Only'])->first()->name }}
                            @else
                              Free
                            @endif
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name ))
                            {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['AM & PM'])->first()->name }}
                          @else
                            @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name ))
                              {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['PM Only'])->first()->name }}
                            @else
                              Free
                            @endif
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name ))
                           {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['AM & PM'])->first()->name }}
                          @else
                            @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name ))
                              {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['PM Only'])->first()->name }}
                            @else
                              Free
                            @endif
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td>7:00pm-9:00pm</td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name ))
                            {{ $scout->classes->where('day', 'Monday')->whereIn('duration', ['Twilight'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name ))
                            {{ $scout->classes->where('day', 'Tuesday')->whereIn('duration', ['Twilight'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name ))
                            {{ $scout->classes->where('day', 'Wednesday')->whereIn('duration', ['Twilight'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name ))
                            {{ $scout->classes->where('day', 'Thursday')->whereIn('duration', ['Twilight'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                        <td>
                          @if(!empty( $scout->classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name ))
                           {{ $scout->classes->where('day', 'Friday')->whereIn('duration', ['Twilight'])->first()->name }}
                          @else
                            Free
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

  </body>
</html>
