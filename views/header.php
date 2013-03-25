<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />

    <title>ClimbIt!</title>

    <!-- Included CSS Files (Compressed) -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300italic|Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="stylesheets/foundation.min.css">
    <link rel="stylesheet" href="stylesheets/app.css">
    <link rel="stylesheet" href="stylesheets/general_foundicons.css">
    <link rel="stylesheet" href="stylesheets/social_foundicons.css">
    <!--<script src="javascripts/modernizr.foundation.js"></script>-->
    <script src="javascripts/foundation.min.js"></script>
    <script src="javascripts/app.js"></script>
    <script src="javascripts/utils.js"></script>
    
    <script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.rc.2/handlebars.min.js"></script>

</head>
<body>
<script type="x-template" id="nav">
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
                        <li class=""><a href="?q=findit">Find a Route</a></li>
                        <li class=""><a href="?q=myclimbs">My Climbs</a></li>
                    </ul>

                    <ul class="right">
                        <li class="divider"></li>

                        {{#user}}
                        <li>
                            <a href="?q=logout" id="logout" onclick="userLogout()">Logout</a>
                        </li>
                        {{/user}}


                        {{^user}}
                        <li>
                            <a href="?q=login" id="login">Login</a>
                        </li>
                        <li class="">
                            <a href="?q=signup">Sign up</a>
                        </li>
                        {{/user}}
                    </ul>
                </section>
            </nav>
        </div>
    </div>
</script>

<script>
    (function(){
        var user = App.getUserDetails();
        if (user == undefined) {
            user = {user:[]};
        }
        var navTmpl = Handlebars.compile($('#nav').html());
        $('body').append(navTmpl(user));
        
    })();
</script>
