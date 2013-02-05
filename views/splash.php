<?php
$user = $_SESSION['user'];
?>

<div class="row">
	<div class="twelve columns panel radius">
		<h1>Hello!</h1>
        <h2 class="subheader left"><small><?=$user->first_name ?> <?=$user->last_name ?></small></h2>
        <h3 class="subheading right"><small><?=$user->userID ?></small></h3>
	</div>
</div>


<div class="row">
    <div class="three columns">
        <h4>New Routes in your area</h4>
        <ul class="disc">
            <li>New Route 1</li>
            <li>New Route 2</li>
            <li>New Route 3</li>
        </ul>
        <hr>
        <h4>Popular climbs near you</h4>
        <ul class="disc">
            <li>Popular Climb 1</li>
            <li>Popular Climb 2</li>
            <li>Popular Climb 3</li>
        </ul>

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
	$("#featured").orbit({
        captions: true,
        advanceSpeed: 6000,
        bullets: true,
        directionalNav: false
    });
</script>

