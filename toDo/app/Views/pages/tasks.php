<h1>Tasks</h1>
<h3>Orher tasks</h3>
<ul>
<?php 
    $cleanArr = [];
    foreach($data['allTasks'] as $task){
        if($task->user_id != session()->get('id')){
        
        if(array_key_exists($task->user_id, $cleanArr)){   
            if($task->status != 'done'){           
                $cleanArr[$task->user_id]['task'][$task->id]['nume_task']=$task->task;
                $cleanArr[$task->user_id]['task'][$task->id]['task_date']=$task->task_date;
                
            }
        }else{          
            $cleanArr[$task->user_id]['name'] = $task->name;            
            if($task->status != 'done'){
                $cleanArr[$task->user_id]['task'][$task->id]['nume_task']=$task->task;
                $cleanArr[$task->user_id]['task'][$task->id]['task_date']=$task->task_date;
            }
        }
        }
    }
    foreach ($cleanArr as $record){
        echo "<b>".$record['name'] . "</b><br>";
        foreach ($record['task'] as $key=>$todo){
            echo "<b>" . $todo['nume_task'] . "</b> - " . $todo['task_date'];     
            echo "<a href='/tasks/markAsDone/" . $key . "'> Mark as done</a> |  ";
            $date1=date_create($todo['task_date']);
            $date2=date_create(date("Y-m-d"));
            $diff=date_diff($date2,$date1);
            echo $diff->format("%R%a days");
            echo "<br>";
        }
        echo "<br>";
    }
?>
</ul>
<hr>
<h3>Taskuri proprii din viitor</h3>
<?php
foreach($data['allTasks'] as $task){
    if($task->user_id == session()->get('id') && $task->status != 'done'){
        echo $task->task . "-" . $task->task_date . " | "; 
        $date1=date_create($task->task_date);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date2,$date1);
        echo $diff->format("%R%a days") ." | ";
        $start_date = $task->task_date;  
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
        echo date('Y/m/d', $date) . "<br>";
    }
}
?>
<hr>
<h2>Add a task</h2>
<form action="/task/add" method="post">
    <textarea name="task"></textarea>
    <p>Please select the task frecvency:</p>
    <input type="radio" id="weekly" name="frecvency" value="weekly">
    <label for="html">Weekly</label><br>
    <input type="radio" id="Monthly" name="frecvency" value="monthly">
    <label for="Monthly">Monthly</label><br>
    <input type="radio" id="Yearly" name="frecvency" value="yearly">
    <label for="Yearly">Yearly</label>
    <br>
    <input type="date" name="taskDate">
    <br><br>
    <button type="submit">Add</button>
</form>
