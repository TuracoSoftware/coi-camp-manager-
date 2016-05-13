<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF Roster</title>

    <link rel="stylesheet" href="{{ URL::asset('../resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('../resources/assets/css/style.css') }}">
  </head>
  <body>
    <div class="row col-md-offset-1">
      <div class="col-md-10 col-md-offset-1">

          <div class="panel-body">

                <div class="panel panel-default">
                  <div class="panel-heading">
                    @if(!empty($sclass))
                      {{ $sclass->name }} -  Week {{ $week }}
                    @endif
                    <br>
                  </div>
                  <div class="panel-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Troop</th>
                          <th>Council</th>
                        </tr>
                      </thead>

                      @foreach($final_scouts as $key => $scout)
                      <tr>
                        <td>
                          {{ $scout->firstname }} {{ $scout->lastname }}
                        </td>
                        <td>
                          {{ $scout->troop->troop }}
                        </td>
                        <td>
                          @if($scout->troop->council == 'Blue Ridge Council')
                            brc
                          @else
                            {{ $scout->troop->council }}
                          @endif
                        </td>
                      </tr>
                      @endforeach

                    </table>
                  </div>
                </div>


            <span>Number of Scouts: {{ $scouts_count }}</span>
          </div>

      </div>
    </div>



  </body>
</html>
