<?php
session_start();
include('connect.php');

$list_id = $_POST['list_id'];
$uid = $_POST['uid'];
    
if($_POST['sortby'] == "sort-priority"){
    $tasks_sql = "SELECT * FROM `tasks` WHERE list_id='$list_id' AND uid='$uid' ORDER BY `task_pri` DESC";
}
else if($_POST['sortby'] == "sort-date"){
    $tasks_sql = "SELECT * FROM `tasks` WHERE list_id='$list_id' AND uid='$uid' ORDER BY `task_due` DESC";
}
$all_tasks = $conn->query($tasks_sql);
if ($all_tasks->num_rows == 0){
    echo ('<br><h6>No tasks yet!</h6>');
}
else{
    while($tasks = $all_tasks->fetch_assoc()){
        echo('<li class="collection-item"><span class="task">'.$tasks['task_name'].'</span>');
        echo('<span class="clear-task"><a class="btn-flat disabled"><i class="material-icons">clear</i></a></span>');
        echo('<p class="grey-text">'.$tasks['task_due'].'</p>');
        echo('</li>');
    } 
} 

?>