<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF Roster</title>
    <style>
      @page rooster {
        size: A4 landscape;
        margin: 2cm;
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
                @if($scout->troop->council == 'Blue Ridge Council')
                  BRC
                @else
                  {{ $scout->troop->council }}
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <span>Number of Scouts: {{ $total_num_scouts[$i] }}</span>
      <div>
        <p>Director's Signature:_______________________________________________________</p>
        <p>Staff Member's Signature:_______________________________________________________</p>
    </div>
  </div>
    @endfor
  </body>
</html>
