<?php
session_start();
include('connect.php');

echo('<div class="col s3">');
echo('<div class="card">');
echo('<div class="card-content center">');
echo('<a href="list.php?list_name=priority"><i class="medium material-icons black-text">stars</i></a>');
echo('<span class="card-title">Priority List</span>');
echo('<p>Priority List</p>');
echo('</div>');
echo('</div>');
echo('</div>');

$list_id = $_POST['list_id'];
$task_del = "DELETE FROM `tasks` WHERE list_id='$list_id'";
$deleted_tasks = $conn->query($task_del);
$check_task = "SELECT * FROM `tasks` WHERE list_id='$list_id'";
$ex_tasks = $conn->query($check_task);
if($ex_tasks->num_rows == 0){
    $list_del = "DELETE FROM `lists` WHERE list_id='$list_id'";
    $deleted_list = $conn->query($list_del);
    if($deleted_list){
//        header('Location: '.$_SERVER['REQUEST_URI']);
        $sess_id = $_SESSION['uid'];
        $user_list = "SELECT * FROM `lists` WHERE uid='$sess_id'";
        $lists = $conn->query($user_list);
        if ($lists->num_rows == 0){
            echo ('<br><h6>No lists yet!</h6>');
        }
        else{
            while($row = $lists->fetch_assoc()){
                echo('<div class="col s3 all-lists">');
                echo('<div class="card">');
                echo('<span class="delete-list" id="'.$row['list_id'].'"><a class="btn-flat"><i class="material-icons">clear</i></a></span>');
                echo('<div class="card-content center">');
                echo('<span class="card-title">'.$row['list_name'].'</span>');
                echo('<p>'.$row['list_desc'].'</p>');
                echo('<a href="list.php?list_name='.$row['list_name'].'"><i class="left material-icons black-text">edit</i></a>');
                echo('</div>');
                echo('</div>');
                echo('</div>');
            }
        }
    }
}

?>