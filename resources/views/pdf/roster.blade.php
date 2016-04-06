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
                          <th></th>
                          <th>Name</th>
                          <th>Troop</th>
                          <th>Council</th>
                          <th>M</th>
                          <th>Tu</th>
                          <th>W</th>
                          <th>Th</th>
                          <th>1a</th>
                          <th>1b</th>
                          <th>2a</th>
                          <th>2b</th>
                          <th>2c</th>
                          <th>3a</th>
                          <th>3b</th>
                          <th>3c</th>
                          <th>4</th>
                          <th>5</th>
                          <th>6</th>
                          <th>7</th>
                          <th>8</th>
                          <th>9</th>
                          <th>10</th>
                        </tr>
                      </thead>

                      @foreach($final_scouts as $key => $scout)
                      <tr>
                        <td>
                          {{ $scout->firstname }} {{ $scout->lastname }}
                        </td>
                        <td>
                          {{ $scout->troop_id }}
                        </td>
                        <td>
                          @if($scout->troop->council == 'Blue Ridge Council')
                            brc
                          @else
                            {{ $scout->troop->council }}
                          @endif
                        </td>
                        <td>M</td>
                        <td>Tu</td>
                        <td>W</td>
                        <td>Th</td>
                        <td>1a</td>
                        <td>1b</td>
                        <td>2a</td>
                        <td>2b</td>
                        <td>2c</td>
                        <td>3a</td>
                        <td>3b</td>
                        <td>3c</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
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
