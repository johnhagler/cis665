<div class="row">
	<div class="twelve columns panel radius">
		<h1>Welcome to ClimbIt!</h1>
        <script id="user" type="x-template">
            {{#user}}
            <h2 class="subheader left"><small>{{first_name}} {{last_name}}</small></h2>
            <h3 class="subheading right"><small>{{user_id}}</small></h3>
            {{/user}}
        </script>
        <div id="user-target"></div>
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
                <p class="intro">Whether you are a beginner or expert, competitive or laid-back, our site provides a centralized place for climbers to 
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

    
    (function (){
        var data = getUserDetails();
        if (data != undefined) {
            var userTmpl = Handlebars.compile($('#user').html());
            var out = userTmpl(data);
            $('#user-target').html(out);
        }
    })();
    
    


    //setup image carosel
	$("#featured").orbit({
        captions: true,
        advanceSpeed: 6000,
        bullets: true,
        directionalNav: false
    });
</script>
