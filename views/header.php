<?php 
//setup nav highlighting based on current view file
$findit = '';
$planit = '';
$climbit = '';
$signup = '';


if ($file_name == 'findit.php') {
  $findit = 'active';
} else if ($file_name == 'planit.php') {
  $planit = 'active';
} else if ($file_name == 'climbit.php') {
  $climbit = 'active';
} else if ($file_name == 'signup.php') {
    $signup = 'active';
}

$login = 'login';
if (isset($user)) {
    $login = 'logout';
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

    <title>Welcome to Foundation</title>

    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="stylesheets/foundation.min.css">
    <link rel="stylesheet" href="stylesheets/app.css">

    <script src="javascripts/modernizr.foundation.js"></script>
    <script src="javascripts/foundation.min.js"></script>
    <script src="javascripts/app.js"></script>

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
                        <li class="<?=$findit ?>"><a href="?q=findit">FindIt</a></li>
                        <li class="<?=$planit ?>"><a href="?q=planit">PlanIt</a></li>
                        <li class="<?=$climbit ?>"><a href="?q=climbit">ClimbIt</a></li>
                    </ul>
                        <ul class="right">
                        <li class="divider"></li>
                        <li><a href="#"  id="<?=$login?>"><?=ucwords($login) ?></a></li>
                        <li class="<?=$signup ?>"><a href="?q=signup">Sign up</a></li>
                    </ul>
                </section>
            </nav>
        </div>
    </div>
