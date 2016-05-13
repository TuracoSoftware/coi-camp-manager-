<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF Roster</title>
    <style>
      @page rooster {
        size: A4 portrait;
        margin: 2cm;
      }
      .rooster-page {
        page: rooster;
        page-break-after: always;
      }
    </style>
  </head>
  <body>
    <div class="rooster-page">
                  <div class="panel-heading">
                    @if(!empty($sclass))
                      {{ $sclass->name }} -  Week {{ $week }}
                    @endif
                    <br>
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
                      @foreach($scouts as $key => $scout)
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
            <span>Number of Scouts: {{ $scouts_count }}</span>
    </div>
  </body>
</html>
