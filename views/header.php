<?php 

//setup nav highlighting based on current view file
$findit = '';
$climbit = '';
$signup = '';


if ($file_name == 'findit.php') {
  $findit = 'active';
} else if ($file_name == 'myclimbs.php') {
  $climbit = 'active';
} else if ($file_name == 'signup.php') {
    $signup = 'active';
}

$login = 'login';
if (isset($_SESSION['user'])) {
    $login = 'logout';
    $user_id = $_SESSION['user']->user_id;
}


 ?>



<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <title>ClimbIt!</title>

    <!-- Included CSS Files (Compressed) -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300italic|Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="stylesheets/foundation.min.css">
    <link rel="stylesheet" href="stylesheets/app.css">
    <link rel="stylesheet" href="stylesheets/general_foundicons.css">
    <!--<script src="javascripts/modernizr.foundation.js"></script>-->
    <script src="javascripts/foundation.min.js"></script>
    <script src="javascripts/app.js"></script>
    <script src="javascripts/utils.js"></script>
    
    <script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.rc.2/handlebars.min.js"></script>

</head>
<body>
    <div class="row">
        <div class="twelve colums">
            <nav class="top-bar">
                <ul>
                    <li class="name"><h1><a href="?q=">ClimbIt!</a></h1></li>
                    <li class="toggle-topbar"><a href="#"></a></li>
                </ul>
                <section>
                    <ul class="left">
                        <li class="divider"></li>
                        <li class="<?php echo $findit ?>"><a href="?q=findit">Find a Route</a></li>
                        <li class="<?php echo $climbit ?>"><a href="?q=myclimbs">My Climbs</a></li>
                    </ul>
                        <ul class="right">
                        <li class="divider"></li>

                        <?php if (isset($_SESSION['user'])) { ?> 

                        <li>
                            <a href="?q=logout" id="logout" onclick="userLogout()">Logout</a>
                        </li>

                        <?php } else { ?>
                        
                        <li>
                            <a href="?q=login" id="login">Login</a>
                        </li>
                        <li class="<?php echo $signup ?>">
                            <a href="?q=signup">Sign up</a>
                        </li>
                        <?php } ?>

                    </ul>
                </section>
            </nav>
        </div>
    </div>
