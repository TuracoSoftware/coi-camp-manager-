@extends('layouts.index')

@section('content')
<section class="content-wrapper">
  <section class="content-header">
  </section>
  <br>
  <section class="content">
    <div class="panel panel-default">
      <div class="panel-heading">{{ $class->name }}</div>
      <div class="panel-body">
        <form action="{{ url('staff/advancement/input') }}" method="POST">
        {!! csrf_field() !!}
          <table class="table table-hover">
            <thead>
              <tr>
                <td>Scout Name</td>
                @foreach($reqs_s[0] as $key=>$val)
                  <td>{{ $val->title }}</td>
                @endforeach
              </tr>
            </thead>
            <input name="meritB" value={{ $meritB->id }} type="hidden">
            <input name="class" value={{ $class->id }} type="hidden">
            <?php $count = 0; ?>
            <tbody>
              <?php $i = 0; ?>
              @foreach($scouts as $key=>$scout)
                <tr>
                  <td>{{ $scout->firstname }} {{ $scout->lastname }}</td>
                  <input name=<?php echo $count++; ?> value={{ $scout->id }} type="hidden">
                    <?php foreach($reqs_s[$i] as $key=>$val) {?>
                      @if($val->test_if_complete == 1)
                        <td>
                          <div class="checkbox">
                            <label>
                              <input name=<?php echo "scout".strval($scout->id)."req".strval($val->id)?> type="checkbox" checked>
                            </label>
                          </div>
                        </td>
                      @else
                        <td>
                          <div class="checkbox">
                            <label>
                              <input name=<?php echo "scout".strval($scout->id)."req".strval($val->id)?> type="checkbox">
                            </label>
                          </div>
                        </td>
                      @endif
                  <?php }
                  $i++; ?>
                </tr>
              @endforeach
            </tbody>
            <input name="number_of_scouts" value=<?php echo $count; ?> type="hidden">
          </table>
          <button type="submit" class="btn btn-default">
            <i class="fa fa-check"></i> Submit
          </button>
        </form>
      </div>
    </div>
  </section>
</section>
@endsection
