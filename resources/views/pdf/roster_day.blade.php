<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF Roster</title>
    <style>
      @page rooster {
        size: A4 landscape;
        margin: 5cm;
      }
      .page-break {
        page: rooster;
        page-break-after: always;
      }
    </style>
  </head>
  <body>
    @for($i = 0; $i < count($total);$i++)
      <div class="page-break">
        <div class="panel-heading">
          {{ $sclasses[$i]->name }} -  Week {{ $week }}
          <div><span>Department: {{ $sclasses[$i]->department }}</span></div>
        </div>
        <div class="panel-body">
          <table border="1" class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Troop</th>
                <th>Council</th>
                @if(!empty($reqs[$i]))
                  @foreach($reqs[$i] as $v)
                    <th>
                      {{ $v }}
                    </th>
                  @endforeach
                @endif
              </tr>
            </thead>
            @foreach($total[$i] as $key => $scout)
            <tr>
              <td>
                {{ $scout->firstname }} {{ $scout->lastname }}
              </td>
              <td>
                {{ $scout->troop->troop }}
              </td>
              <td>
                {{ $scout->troop->council }}
              </td>
                @if(!empty($reqs[$i]))
                  @foreach($reqs[$i] as $v)
                    <td>

                    </td>
                  @endforeach
                @endif
              </tr>
            @endforeach
          </table>
        </div>
        <span>Number of Scouts: {{ $sclasses[$i]->count_scouts_week($week) }}</span>
        <p>Director's Signature:_______________________________________________________</p>
        <br>
        <p>Staff Member's Signature:_______________________________________________________</p>
      </div>
    @endfor
  </body>
</html>
