<?php 
session_start();
include('scripts/php/connect.php');
include('scripts/php/auth.php');

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>First</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css" rel="stylesheet" />

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
        <nav class="nav-wrapper pink darken-3">
            <div class="container">
                <a id="logo-container" href="dash.php" class="brand-logo">KeepMeListed</a>  
                <ul class="right">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="#" id="login">Log In</a></li>
                </ul>
            </div>
        </nav>
        <?php include('scripts/php/errors.php'); ?>
        <div id="login-form" class="webui-popover-content">
            <h5>Login</h5>
            <form action="index.php" method="POST">
                <div class="input-field">
                    <input type="text" name="username" id="username" required>
                    <label for="username">Username</label>    
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field">
                    <button type="submit" class="center btn" name="login">Login</button>
                </div>
            </form>
        </div>
    <!-- <h1>Hello Materialize</h1> -->
    <div class="parallax-container">
        <!-- heading -->
        <div class="parallax">
            <img src="img/prod.jpg" alt="" class="responsive-img">
        </div>
    </div>

    <div class="container">
        <!-- features -->
        <h1>KeepMeListed</h1>
        <div class="row center">
            <div class="col s4">
                <i class="medium material-icons">schedule</i>
                <h3>Organize</h3>
                <p>Schedule all your tasks to be completed and 
                    never have to worry about missing out on anything. 
                    Last minute late submissions not anymore. </p>
            </div>
            <div class="col s4">
                <i class="medium material-icons">sort</i>
                <h3>Categorize</h3>
                <p>List tasks related to similar goals together.
                    One list for all your chores, one for your bills, 
                    and maybe one more for last minute revision.
                </p>
            </div>
            <div class="col s4">
                <i class="medium material-icons">star</i>
                <h3>Prioritize</h3>
                <p>Order all your tasks with a priority.
                    An automatically generated priority list 
                    for your most important tasks. Tailored as 
                    per your priorities.
                </p>
            </div>
            <div class="col s12">
                <h4>Don't miss out on the Fast Add feature!</h4>
            </div>
        </div>
    </div>

    <div class="parallax-container">
        <div class="parallax">
            <img src="img/office.jpg" alt="" class="responsive-img">
        </div>
    </div>

    <div class="container">
        <!-- join -->
        <h1>Liked what you saw?</h1>
        <h6>Sign up now and get on your way to a stress free day.</h6>
        <div class="row">
            <div class="col s5 center">
                <form action="index.php" method="POST">
                    <div class="input-field">
                            <input type="text" name="username" id="username" required>
                            <label for="username">Username</label>    
                        </div>
                <div class="input-field">
                    <input type="text" name="email" id="email" required>
                    <label for="email">Email</label>    
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field">
                    <button type="submit" class="btn" name="register">Sign Up</button>
                </div>
            </form>
            </div>
            <div class="col offset-s1 s5 center">
                <h6>Already a member? Login to get back</h6>
                <form action="index.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="username" id="username" required>
                        <label for="username">Username</label>    
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field">
                        <button type="submit" class="btn" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="parallax-container">
        <div class="parallax">
            <img src="img/camera.jpg" alt="" class="responsive-img">
        </div>
    </div>
    <div class="modal" id="signupModal"></div>
    <footer>
        <div class="footer center">
            <i class="small material-icons">blur_on</i><span>Jyeshtha Vartak</span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="scripts/js/init.js"></script>
</body>
</html>