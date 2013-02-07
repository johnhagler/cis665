<?php
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : new User() ;

?>

<div class="row">
	<div class="twelve columns panel radius">
		<h1>Hello!</h1>
        <h2 class="subheader left"><small><?= $user->first_name ?> <?= $user->last_name ?></small></h2>
        <h3 class="subheading right"><small><?= $user->user_id ?></small></h3>
	</div>
</div>


<div class="row">
    <div class="three columns">
        <script id="routes-template" type="text/x-handlebars-template">
            <ul class="disc">
            {{#routes}}
                <li>
                    <h5 style="margin:0 0 -8px 0;"><a href="#">{{route}}</a></h5>
                    <p style="margin:0;">{{area}}, {{crag}}</p>
                </li>
            {{/routes}}
            </ul>
        </script>
        <h4>New Routes</h4>
        <div id="new-routes"></div>
        <h4>Popular Routes</h4>
        <div id="popular-routes"></div>
    </div>
    <div class="nine columns">
        <div id="featured">
            <img src="images/cliffWater.png" alt="feature 1">
            <img src="images/pointSky.png" alt="feature 2">
            <img src="images/rockClimbWomanSky.png" alt="feature 3">

        </div>

        <div class="row">
            <div class="eight columns">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus est modi veritatis ducimus beatae labore culpa voluptate corporis dicta consectetur adipisci eos ut ea blanditiis inventore assumenda maiores nostrum praesentium.</p>
            </div>
            <div class="four columns">
                <a href="#" class="large button radius">Sign up NOW</a>
            </div>
        </div>
    </div>
<script type="text/javascript">
    tmpl = Handlebars.compile($("#routes-template").html());

    $.getJSON('models/data.php?q=newRoutes', function(json) {
        $('#new-routes').after(tmpl(json));
    });
    $.getJSON('models/data.php?q=popularRoutes', function(json) {
        $('#popular-routes').after(tmpl(json));
    });

</script>

<script type="text/javascript">
	$("#featured").orbit({
        captions: true,
        advanceSpeed: 6000,
        bullets: true,
        directionalNav: false
    });
</script>

