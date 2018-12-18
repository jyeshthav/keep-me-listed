<?php
include('scripts/php/connect.php');
include('scripts/php/news.php');
 if (!isset($_SESSION['username'])) {
    array_push($errors, "Log in first");
  	header('location: index.php');
  }

  if (isset($_GET['logout'])) {
  	session_destroy();
    unset($_SESSION['username']);
  	header("location: index.php");
  }

$list_name = "";
$list_id = "";
$uid = $_SESSION['uid'];

$l_name = $_GET['list_name'];
if ($l_name == 'priority'){
    $list_name = 'Priority list';
}
else{
    $list_stuff = "SELECT * FROM `lists` WHERE list_name='$l_name' AND uid='$uid' LIMIT 1";
    $list_data = $conn->query($list_stuff);
    if($list_data->num_rows == 1){
        $deets = $list_data->fetch_assoc();
        $list_name = $deets['list_name'];
        $list_id = $deets['list_id'];
    }
    else{
        $errors = array();
        array_push($errors, "some error");
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dash</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/list.css" class="rel">
</head>
<body>
    <nav class="nav-wrapper pink darken-3">
        <div class="container">
            <a id="logo-container" href="#" class="brand-logo">KeepMeListed</a>
            <ul class="right">
                <li><a href="dash.php">My Lists</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="dash.php?logout='1'">Log Out</a></li>
            </ul>   
        </div>
    </nav>
    <?php include('scripts/php/errors.php'); ?>
    <div class="container">
        <div class="row">
            <div class="center col s12">
                <?php echo('<h1>'.$list_name.'</h1>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col s2">
               <?php
                if($list_name != 'Priority list'){
                    echo('<h5>Sort by:</h5>');
                    echo('<div><p>');
                    echo('<label>');
                    echo('<input class="with-gap sorting" name="'.$list_id.'" uid="'.$uid.'" type="radio" id="sort-priority" checked="checked" />');
                    echo('<span class="sort-by">Priority</span>');
                    echo('</label>');
                    echo('</p></div>');
                    echo('<div><p>');
                    echo('<label>');
                    echo('<input class="with-gap sorting" name="'.$list_id.'" uid="'.$uid.'" type="radio" id="sort-date" />');
                    echo('<span class="sort-by">Due date</span>');
                    echo('</label>');
                    echo('</p></div>');
                }
                else{
                    echo('<div class="col s2"><h5>..</h5></div>');
                }
                
                ?>
            </div>
            <div class="col s6">
                <h5>Tasks</h5>
                <!-- collection -->
                <ul class="collection">
                  
                   <?php
                    
                    if($list_name != 'Priority list'){
                        echo('<div class="all-tasks">');
                       $tasks_sql = "SELECT * FROM `tasks` WHERE list_id='$list_id' AND uid='$uid' ORDER BY task_pri DESC";
                        $all_tasks = $conn->query($tasks_sql);
                        if ($all_tasks->num_rows == 0){
                            echo ('<br><h6>No tasks yet!</h6>');
                        }
                        else{
                            while($tasks = $all_tasks->fetch_assoc()){
                                echo('<li class="collection-item status unchecked" data-status="'.$tasks['task_status'].'" name="'.$tasks['task_name'].'" id="'.$tasks['task_id'].'" uid="'.$uid.'"><span class="task">'.$tasks['task_name'].'</span>');
                                echo('<span class="clear-task" id="'.$tasks['task_id'].'"><a class="btn-flat disabled"><i class="material-icons">clear</i></a></span>');
                                echo('<p class="grey-text">'.$tasks['task_due'].'</p>');
                                echo('</li>');
                            } 
                        }
                        echo('</div>');
                    }
                    else{
                        $tasks_q = "SELECT * FROM `tasks` WHERE uid='$uid' ORDER BY task_pri DESC LIMIT 10";
                        $all_tasks = $conn->query($tasks_q);
                        if ($all_tasks->num_rows == 0){
                            echo ('<br><h6>No tasks yet!</h6>');
                        }
                        else{
                            while($tasks = $all_tasks->fetch_assoc()){
                                echo('<li class="collection-item"><span class="task">'.$tasks['task_name'].'</span>');
                                echo('<p class="grey-text">'.$tasks['task_due'].'</p>');
                                echo('</li>');
                            } 
                        }
                    }
                    ?>
                    
                </ul>
            </div>
            <?php
            
            if($list_name != 'Priority list'){
                echo('<div class="col s4">');
                echo('<h5>Add new task</h5>');
                echo('<form action="list.php?list_name='.$list_name.'" method="POST">');
                echo('<table>');
                echo('<tr>');
                echo('<td>Task name:</td>');
                echo('<td><input type="text" name="task_name" required></td>');
                echo('</tr>');
                echo('<tr>');
                echo('<td>Task priority:</td>');
                echo('<td><input type="range" min="1" max="10" value="5" name="task_pri"></td>');
                echo('</tr>');
                echo('<tr>');
                echo('<td>Due Date:</td>');
                echo('<td><input type="text" id="date" class="datepicker" name="task_due" required></td>');
                echo('</tr>');
                echo('</table>');
                echo('<div class="input-field center">');
                echo('<button class="btn" type="submit" name="add">Add</button>');
                echo('</div>');
                echo('</form');
                echo('</div>');
            }
            else{
                echo('<div class="col s4"><h5>..</h5></div>');
            }
            
            ?>
        </div>
   
    </div>
    <footer>
        <div class="container footer center">
            <i class="small material-icons">blur_on</i><span>Jyeshtha Vartak</span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="scripts/js/list.js"></script>
</body>
</html>