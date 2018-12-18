<?php
session_start();
include('connect.php');

$list_name = "";
$list_desc = "";
$task_name = "";
$task_pri = "";
$task_due = "";
$uid = $_SESSION['uid'];
$errors = array();

if(isset($_POST['create_list'])){
//    echo "new list";
    $list_name = filter_var($_POST['list_name'], FILTER_SANITIZE_STRING);
    $list_desc = filter_var($_POST['list_desc'], FILTER_SANITIZE_STRING);
    
    $ex_list = "SELECT * FROM `lists` WHERE uid='$uid' AND list_name='$list_name'";
    $ex_lists = $conn->query($ex_list);
    if ($ex_lists->num_rows > 0){
        array_push($errors, "List already exists!");
    }
    else{
        $ins_list = "INSERT INTO `lists`(`uid`, `list_name`, `list_desc`) VALUES ($uid, '$list_name', '$list_desc')";
        $insert = $conn->query($ins_list);
        if(!$insert){
            array_push($errors, "Some error occured");
        }
    }
}

if(isset($_GET['add_task'])){

    $list_name = filter_var($_GET['list_name'], FILTER_SANITIZE_STRING);
    $list_stuff = "SELECT * FROM `lists` WHERE list_name='$list_name' AND uid='$uid' LIMIT 1";
    $list_data = $conn->query($list_stuff);
    if($list_data->num_rows == 1){
        $deets = $list_data->fetch_assoc();
        $list_id = $deets['list_id'];
        $task_name = filter_var($_GET['task_name'], FILTER_SANITIZE_STRING);
        $task_pri = filter_var($_GET['task_pri'], FILTER_SANITIZE_STRING);
        $task_due = date('Y-m-d', strtotime($_GET['task_due']));

        $ex_task = "SELECT * FROM `tasks` WHERE list_id='$list_id' AND task_name='$task_name' AND uid='$uid'";
        $ex_tasks = $conn->query($ex_task);
        if ($ex_tasks->num_rows > 0){
            array_push($errors, "Task already exists!");
        }
        else{
            $ins_task = "INSERT INTO `tasks`(`uid`, `list_id`, `task_name`, `task_pri`, `task_due`) VALUES ('$uid', '$list_id', '$task_name', '$task_pri', '$task_due')";
            $insert_task = $conn->query($ins_task);
            if(!$insert_task){
                array_push($errors, "Some error occured");
            }
            else{
                array_push($errors, "Task added successfully!");
            }
        }   
    }
    else{
        array_push($errors, "no such list");
    }
}

if(isset($_POST['add'])){
    
    $list_name = $_GET['list_name'];
    $list_stuff = "SELECT * FROM `lists` WHERE list_name='$list_name' AND uid='$uid' LIMIT 1";
    $list_data = $conn->query($list_stuff);
    if($list_data->num_rows == 1){
        $deets = $list_data->fetch_assoc();
        $list_id = $deets['list_id'];
    }
    else{
        array_push($errors, "some error");
    }
    
    $task_name = filter_var($_POST['task_name'], FILTER_SANITIZE_STRING);
    $task_pri = filter_var($_POST['task_pri'], FILTER_SANITIZE_STRING);
    $task_due = date('Y-m-d', strtotime($_POST['task_due']));
                     
    
    $ex_task = "SELECT * FROM `tasks` WHERE list_id='$list_id' AND task_name='$task_name' AND uid='$uid'";
    $ex_tasks = $conn->query($ex_task);
    if ($ex_tasks->num_rows > 0){
        array_push($errors, "Task already exists!");
    }
    else{
        $ins_task = "INSERT INTO `tasks`(`uid`, `list_id`, `task_name`, `task_pri`, `task_due`) VALUES ('$uid', '$list_id', '$task_name', '$task_pri', '$task_due')";
        $insert_task = $conn->query($ins_task);
        if(!$insert_task){
            array_push($errors, "Some error occured");
        }
        else{
            array_push($errors, "Task added successfully!");
        }
    }   
}
?>