<style>
    table{width: 95%; text-align: left; margin-bottom: 50px}
    td, th{border: 1px solid #ccc; padding: 10px;}
    .taskName{width: 45%}
</style>

<h1>Tasks</h1>
<h3>Orher tasks</h3>  

<table>
  <thead>
    <tr>
      <th>Company</th>
      <th>To do date</th>
      <th>Days</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Add message & deadline</th>
      <th>Mark as done</th>
    </tr>
  </thead>
  <tbody>

<?php 
    $cleanArr = [];
    foreach($data['allTasks'] as $task){
      
        if($task->user_id != session()->get('id')){
          // echo "<pre>";
          // print_r($data['allTasks']);die;
        
        if(array_key_exists($task->user_id, $cleanArr)){   
            if($task->status != 'done'){           
                $cleanArr[$task->user_id]['company'][$task->id]['company']=$task->company;
                //$cleanArr[$task->user_id]['company'][$task->id]['task_date']=$task->task_date;
            }
        }else{          
            $cleanArr[$task->user_id]['name'] = $task->name;            
            if($task->status != 'done'){
                $cleanArr[$task->user_id]['company'][$task->id]['company']=$task->company;
                //$cleanArr[$task->user_id]['company'][$task->id]['task_date']=$task->task_date;
            }
        }
      }
      echo "<pre>";
      print_r($cleanArr); die;
    }
    foreach ($cleanArr as $record){
        echo "<b>".$record['name'] . "</b><br>";

        foreach ($record['task'] as $key=>$todo){
            $date1=date_create($todo['task_date']);
            $date2=date_create(date("Y-m-d"));
            $diff=date_diff($date2,$date1);
?>


    <tr>
      <td class="taskName"><?= $todo['nume_task'] ?></td>
      <td><?= $todo['task_date'] ?></td>
      <td><?= $diff->format("%R%a days") ?></td>
      <th>Name</th>
      <th>Phone</th>
      <td>
        <form action="task/addMessage" method="get">
            <textarea name="taskMessage" rows="3" cols="50">Message</textarea>
            <input type="date" name="taskDate">
            <input type="hidden" name="taskId" value="<?= $task->id ?>">
            <button type="submit">Add</button>
        </form>
    </td>
      <td><a href='/tasks/markAsDone/" <?= $key ?> "'> Mark as done</a></td>      
    </tr>    



            <!-- echo "<b>" . $todo['nume_task'] . "</b> - " . $todo['task_date'];     
            echo "<a href='/tasks/markAsDone/" . $key . "'> Mark as done</a> |  ";
            
            echo $diff->format("%R%a days");
            echo "<br>"; -->
<?php

        }


        
       
    }
?>
  </tbody>  
</table>


<h3>Taskuri proprii din viitor</h3>
<table>
  <thead>
    <tr>
      <th>Task</th>
      <th>To do date</th>
      <th>Days</th>
      <th>Add message & deadline</th>
      <th>Mark as done</th>
    </tr>
  </thead>
  <tbody>
<?php
// echo "<pre>";
// print_r($data['allTasks']); die;
foreach($data['allTasks'] as $task){
    if($task->user_id == session()->get('id') && $task->status != 'done'){
        $date1=date_create($task->task_date);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date2,$date1);

        $start_date = $task->task_date;  
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
?>

        <!-- echo $task->task . "-" . $task->task_date . " | "; 
        echo "<a href='/tasks/markAsDone/" . $task->id . "'> Mark as done</a> |  ";
        $date1=date_create($task->task_date);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date2,$date1);
        echo $diff->format("%R%a days") ." | ";
        $start_date = $task->task_date;  
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
        echo date('Y/m/d', $date) . "<br>"; -->

        <tr>
      <td class="taskName"><?= $task->task ?></td>
      <td><?= $task->task_date ?></td>
      <td><?= $diff->format("%R%a days") ?></td>
      <td>
      <form action="task/addMessage" method="get">
            <textarea name="taskMessage" rows="3" cols="50">Message</textarea>
            <input type="date" name="taskDate">
            <input type="hidden" name="taskId" value="<?= $task->id ?>">
            <button type="submit">Add</button>
        </form>
    </td>
      <td><a href='/tasks/markAsDone/" <?= $task->id ?> "'> Mark as done</a></td>      
    </tr>    


<?php
    }
}
?>
  </tbody>  
</table>
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
    <br>

    <label for="assignTo">Assign to:</label>
    <select name="assignTo">
        <?php
            foreach ($data['users'] as $user):
        ?>
        <option value="<?= $user->id ?>"><?= $user->name; ?></option>
        <?php
            endforeach;
        ?>        
    </select>
    <br><br>
    <button type="submit">Add</button>
</form>