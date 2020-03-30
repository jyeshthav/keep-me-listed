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
    <link rel="stylesheet" href="css/dash.css" class="rel">
</head>
<body>
    <nav class="nav-wrapper pink darken-3">
        <div class="container">
            <a id="logo-container" href="index.php" class="brand-logo">KeepMeListed</a>
            <ul class="right">
                <li><a href="#listModal" class="modal-trigger">New</a></li>
                <li class="active"><a href="#">My Lists</a></li>
                <li><a href="dash.php?logout='1'">Log Out</a></li>
            </ul>   
        </div>
    </nav>
    <?php include('scripts/php/errors.php'); ?>
        <div class="container">
            <h2>Welcome, <?php echo $_SESSION['username'] ?></h2>
            <h4>Here's what we got to do!</h4>
            <div class="row">
                <!-- priority list -->
                <div class="col s3">
                    <div class="card">
                        <div class="card-content center">
                            <a href="list.php?list_name=priority"><i class="medium material-icons black-text">stars</i></a>
                            <span class="card-title">Priority List</span>
                            <p>Priority List</p>
                        </div>
                    </div>
                </div>
                
                <!-- list loop -->
                <?php 
                
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
                
                ?>
            </div>
        </div>
   
    <div class="container fixed-action-btn">
        <a href="" class="right btn-floating yellow darken-3 btn-large pulse">
            <i class="material-icons">add</i>
        </a>
        <ul>
            <li><a href="#listModal" class="btn-floating red modal-trigger tooltipped" data-position="top" data-tooltip="New List"><i class="material-icons">menu</i></a></li>
            <li><a href="#taskModal" class="btn-floating red modal-trigger tooltipped" data-position="top" data-tooltip="New Task"><i class="material-icons">check</i></a></li>
        </ul>
    </div>

    <div class="modal" id="listModal">
        <div class="modal-content">
            <span class="right modal-close"><i class="material-icons">close</i></span>
            <form action="dash.php" method="POST">
                <table>
                    <thead><h4>Create a new list</h4></thead>
                    <tr>
                        <td>List name:</td>
                        <td><input type="text" name="list_name" required></td>
                    </tr>
                    <tr>
                        <td>List Description:</td>
                        <td><input type="text" name="list_desc"></td>
                    </tr>
                </table>
                <div class="input-field center">
                    <button class="btn" type="submit" name="create_list">Create List</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal" id="taskModal">
        <div class="modal-content">
            <span class="right modal-close"><i class="material-icons">close</i></span>
            <form action="dash.php" method="GET">
                <table>
                    <thead><h4>Add a new task</h4></thead>
                    <tr>
                        <td>List name:</td>
                        <td><input type="text" name="list_name" required></td>
                    </tr>
                    <tr>
                        <td>Task name:</td>
                        <td><input type="text" name="task_name" required></td>
                    </tr>
                    <tr>
                        <td>Task priority:</td>
                        <td><input type="range" min="1" max="10" value="5" name="task_pri"></td>
                    </tr>
                    <tr>
                        <td>Due Date:</td>
                        <td><input type="text" id="date" class="datepicker" name="task_due" required></td>
                    </tr>
                </table>
                <div class="input-field center">
                    <button class="btn" type="submit" name="add_task">Add task</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer center">
            <i class="small material-icons">blur_on</i><span>Jyeshtha Vartak</span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="scripts/js/dash.js"></script>
</body>
</html>