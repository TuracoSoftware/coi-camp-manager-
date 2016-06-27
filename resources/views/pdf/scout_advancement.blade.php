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

    </style>
  </head>
  <body>
    <?php $i=0; ?>
    @foreach($meritBs_s as $meritB_s)
      <div class="page-break">
        <div class="panel-heading">
          {{ $scout->lastname }}, {{ $scout->firstname}}: {{ $meritB_s->name }}
        </div>
      </div>
      <div class="panel-body">
        <table border="1" class="table">
          <thead>
            <tr>
              <th>Requirement Title:</th>
              @foreach($reqs_s[$i] as $key=>$req_s)
                <th>{{ $req_s->title }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach($reqs_s[$i] as $key=>$req_s)
                <td>
                  @if($req_s->test_if_complete == 1)
                    X
                  @else

                  @endif
                </td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
      <<?php $i++; ?>
    @endforeach
  </body>
</html>
