@extends('admin.index')

@section('content')
<div class="container">
    <div class="row col-md-offset-1">
        <div class="col-md-10 col-md-offset-1">

            <br>
            <div class="row">

              <!-- New Scout button -->
              <div class="col-md-12">
                <div class="mar-12">
                  <h3 class="title_c">Create a Roster</h3>
                </div>
              </div>

              <!-- Search form -->
              <div class="col-md-12">
                <div class="mar-12">
                  <form class="navbar-form" role="search" action="{{ URL::to('administrator/roster') }}" method="POST">
                    <div class="input-group">
                        {!! csrf_field() !!}
                        <div class="col-md-6">
                          <select name="sclass" class="form-control" id="sclass">
                            <option value="0">--Select a class--</option>
                            @foreach($sclasses as $key => $value)
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <select name="week" class="form-control" id="week">
                            <option value="0">--Select a week--</option>
                            <option value="1">Week 1</option>
                            <option value="2">Week 2</option>
                            <option value="3">Week 3</option>
                            <option value="4">Week 4</option>
                            <option value="5">Week 5</option>
                            <option value="6">Week 6</option>
                            <option value="7">Week 7</option>
                          </select>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
  
  @if(!empty($final_scouts))
    <div class="row col-md-offset-1">
      <div class="col-md-10 col-md-offset-1">

          <div class="panel-body">
            <div class="form">
                
                <div class="panel panel-default">
                  <div class="panel-heading">
                    @if(!empty($sclass))
                      {{ $sclass->name }} -  Week {{ $week }}
                    @endif
                    <a href="{{ URL::to('roster_print_view/'.$sclass->id.'/'.$week.'/') }}" target="_blank"><i class="fa fa-print"> Print Roster</i></a>
                  </div>
                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td>Troop</td>
                          <td>Council</td>
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
                          {{ $scout->troop->council }}
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
            

            </div>
            <span>Number of Scouts: {{ $scouts_count }}</span>
          </div>

      </div>
    </div>
  @else
    <div class="row col-md-offset-1">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel-body">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>not found</h3>
            </div>
          </div>
        </div>
    </div>
  @endif


</div>
@endsection
