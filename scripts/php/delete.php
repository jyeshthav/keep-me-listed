<?php
session_start();
include('connect.php');

$task_id = $_POST['task_id'];

$tasks_del = "DELETE FROM `tasks` WHERE task_id='$task_id'";
$deletion = $conn->query($tasks_del);
if ($deletion){
//    array_push($errors, "Successfully deleted task!");
    header('Location: '.$_SERVER['REQUEST_URI']);
}
else{
    array_push($errors, "Some error occured");
} 


?>