
<div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header">
      <i class="ion ion-clipboard"></i>
      <h3 class="box-title">{{ __('dashboard.To Do List') }}</h3>
    </div>
    <div class="box-body">
      <ul class="todo-list">
        @foreach($tasks as $task)
          <li>
            <span class="handle">
              <i class="fa fa-ellipsis-v"></i>
              <i class="fa fa-ellipsis-v"></i>
            </span>
            <span class="text">{{$task->task_title}}: </span>
            <span class="text">{{$task->description}}</span>
            <?php 
              $target = date('Y-m-d', strtotime($task->updated_at. ' + '.$task->duration.' days'));
              $target1 = date_create($target);
              $current = date("Y-m-d");
              $current1 = date_create($current);
              $interval = date_diff($current1, $target1);
              if($interval->format("%R") == '-')
                echo'<small class="label label-danger"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .' ago!</small>';
              else if($interval->format("%R") == '+' && $interval->format("%a") <10 )
                echo'<small class="label label-danger"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .'</small>';
              else if($interval->format("%R") == '+' && $interval->format("%a") <15)
                echo'<small class="label label-warning"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .'</small>';
              else if($interval->format("%R") == '+' && $interval->format("%a") <20)
                echo'<small class="label label-info"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .'</small>';
              else if($interval->format("%R") == '+' && $interval->format("%a") <25)
                echo'<small class="label label-success"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .'</small>';
              else if($interval->format("%R") == '+' && $interval->format("%a") >=25)
                echo'<small class="label label-default"><i class="fa fa-clock-o"></i>'. $interval->format("%a days") .'</small>';
            ?>
            <span class="text"></span>
            <div class="tools">
              <i data-id="{{$task->id}}" class="fa fa-edit edit"></i>
              <i data-id="{{$task->id}}" class="fa fa-trash-o delete"></i>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="box-footer clearfix no-border">
      <button type="button" data-toggle="modal" data-target="#modalAdd" class="Open_Modal btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ __('dashboard.Add item') }}</button>
    </div>
  </div>
</div>