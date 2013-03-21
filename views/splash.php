<div class="row">
	<div class="twelve columns panel radius">
		<h1>Welcome to ClimbIt!</h1>
        <h2 class="subheader left"><small id="user_name"></small></h2>
        <h3 class="subheading right"><small id="user_id"></small></h3>
	</div>
</div>


<div class="row">
    <div class="three columns">
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
            <div class="twelve columns">
                <p class="byline">Are you a climbing enthusiast? <br> Then you are at the right place! </p>
                <p>Whether you are a beginner or expert, competitive or laid-back, our site provides a centralized place for climbers to 
                    search for great new routes to climb and crags to visit, discover new projects, plan your climbing trips, record your climbing 
                    experiences and track your progress over time. Hope you enjoy it!
                <p class="signoff"> &mdash; Climb on! </p>
            </div>
        </div>
    </div>




<script type="text/javascript">

    //load the templates for the new and popular routes
    var tmpl;
    var loadTmpl = $.get('views/templates/route_splash.html', function(data) {
        tmpl = Handlebars.compile(data);
    });

    // pipe over and load the data for new and popular routes
    loadTmpl.pipe(
        function() {
            $.getJSON('?q=new_routes', function(json) {
                $('#new-routes').after(tmpl(json));
            });
            $.getJSON('?q=popular_routes', function(json) {
                $('#popular-routes').after(tmpl(json));
            });
        }
    );

    
    //get user info
    $.getJSON('?q=user_details', function(user) {
        if (user) {
            $('#user_name').html(user.first_name + ' ' + user.last_name);
            $('#user_id').html(user.user_id);
        }
    });

    //setup image carosel
	$("#featured").orbit({
        captions: true,
        advanceSpeed: 6000,
        bullets: true,
        directionalNav: false
    });
</script>
