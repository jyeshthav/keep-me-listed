<?php
session_start();
include('connect.php');

$task_id = $_POST['task_id'];
$task_name = $_POST['name'];
$uid = $_POST['uid'];
$current = $_POST['status'];
$result = "";

$get_task = "SELECT * FROM `tasks` WHERE task_id='$task_id' AND task_name='$task_name' AND uid='$uid'";
$task = $conn->query($get_task);
if ($task){
    if ($current == 'unchecked'){
        $status_update = "UPDATE tasks SET task_status='checked' WHERE task_id='$task_id' AND uid='$uid'";
        $update = $conn->query($status_update);
        if($update){
            $result = 'checked';
            echo json_encode($result);
        }
    }
    else if($current == 'checked'){
        $status_update = "UPDATE tasks SET task_status='unchecked' WHERE task_id='$task_id' AND uid='$uid'";
        $update = $conn->query($status_update);
        if($update){
            $result = 'unchecked';
            echo json_encode($result);
        }
    }
    
}
else{
    echo "no such task exists";
}



?>