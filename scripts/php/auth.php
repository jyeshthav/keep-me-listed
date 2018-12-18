<?php
include('connect.php');

$username = "";
$email = "";
$pwd = "";
$errors = array();

if (isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email format"); 
    }
    else{
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    
    $user_sql = "SELECT * FROM `users` WHERE email='$email' LIMIT 1";
    $user_check = $conn->query($user_sql);
    if ($user_check->num_rows > 0){
        array_push($errors, "User already exists"); 
    }
    
    if (count($errors) == 0) {
  	//$password = md5($password);//encrypt the password before saving in the database
        $new_user = "INSERT INTO `users`(`username`, `email`, `pwd`) VALUES ('$username','$email','$pwd')";
        $insert = $conn->query($new_user);
        $_SESSION['uid'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        header('location: dash.php');
  }
}

if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $login = "SELECT * FROM `users` WHERE username='$username' AND pwd='$pwd' LIMIT 1";
    $log_user = $conn->query($login);
    $user = $log_user->fetch_assoc();
    if ($log_user->num_rows == 1){
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['username'] = $username;
        header('location: dash.php'); 
    }
    else{
        array_push($errors, "Invalid username and password combination");
    }
}
?>