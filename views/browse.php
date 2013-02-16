<style type="text/css">

	#panels td a {
		font-size:1.25em;
		font-weight:bold;
	}
	#panels td {
		vertical-align: middle;
	}

	#panels {
		overflow: hidden;
	}

	#panels section {
		width:100%; position: absolute;
		-webkit-transition: 0.25s all ease-in; 
		-moz-transition: 0.25s all ease-in; 
		-o-transition: 0.25s all ease-in; 
		transition: 0.25s all ease-in; 

	}

	#panels.section-1 #section-1 {
		margin-left:0; 
		position: relative;
	}
	#panels.section-1 #section-2 {
		margin-left:150%; 
	}
	#panels.section-1 #section-3 {
		margin-left:250%; 
	}
	#panels.section-1 #section-4 {
		margin-left:350%; 
	}

	#panels.section-2 #section-1 {
		margin-left:-150%; 
	}
	#panels.section-2 #section-2  {
		margin-left:0; 
		position: relative;
	}
	#panels.section-2 #section-3 {
		margin-left:150%; 
	}
	#panels.section-2 #section-4 {
		margin-left:250%; 
	}

	#panels.section-3 #section-1 {
		margin-left:-250%; 
	}
	#panels.section-3 #section-2  {
		margin-left:-150%; 
	}
	#panels.section-3 #section-3 {
		margin-left:0; 
		position: relative;
	}
	#panels.section-3 #section-4 {
		margin-left:150%; 
	}

	#panels.section-4 #section-1 {
		margin-left:-350%; 
	}
	#panels.section-4 #section-2  {
		margin-left:-250%; 
	}
	#panels.section-4 #section-3 {
		margin-left:-150%; 
	}
	#panels.section-4 #section-4 {
		margin-left:0; 
		position: relative;
	}


</style>

<div class="row">
	<div class="twelve colums panel radius">
		<h1>FindIt!</h1>
	</div>
</div>

<div class="row" style="margin-bottom:14px;">
    <div class="twelve columns">
        <span class="label round secondary"><a href="?q=search" style="color:#666;">Search</a></span>
        <span class="label round">Browse</span>
    </div>
</div>


<div class="row">
	<div class="six mobile-four columns">
		<ul class="button-group twelve even two-up">
			<li><a href="#" class="button secondary disabled back-panel">
				<i class="foundicon-left-arrow"></i>
			</a></li>
		</ul>
	</div>
</div>

<div id="panels" class="section-1">
	<div class="row">
		<div class="twelve columns">
			
			<section id="section-1">
				<h2>Area</h2>
				<?php include 'templates/browse_list_areas.php'; ?>
				<table class="ten" id="list-areas"></table>
			</section>

			<section id="section-2" class="">
				<h2>Crag</h2>
				<?php include 'templates/browse_list_crags.php'; ?>
				<table class="ten" id="list-crags"></table>
			</section>

			<section id="section-3" class="">
				<h2>Routes</h2>
				<?php include 'templates/browse_list_routes.php'; ?>
				<table class="ten" id="list-routes"></table>
			</section>

			<section id="section-4" class="">
				<?php include 'templates/route_details.php'; ?>
				<div id="route-details"></div>
			</section>

		</div>
	</div>
</div>

<div class="row">
	<div class="six mobile-four columns">
		<ul class="button-group even two-up">
			<li><a href="#" class="button secondary disabled back-panel">
				<i class="foundicon-left-arrow"></i>
			</a></li>
		</ul>
	</div>
</div>

<script type="text/javascript">
	var areaTmpl = Handlebars.compile($("#list-areas-template").html());
	var cragTmpl = Handlebars.compile($("#list-crags-template").html());
	var routeTmpl = Handlebars.compile($("#list-routes-template").html());
	var detailTmpl = Handlebars.compile($("#route-details-template").html());


	$.getJSON('?q=list_areas', function(json) {
		$('#list-areas').html(areaTmpl(json));
		$('#section-1 a').click(function(){
			showNextPanel($(this));
		});
	});
	
	

	function showNextPanel(elem) {

		var request = elem.html();
		
		var s = $('#panels').attr('class');		
		var num = Number(s.substring(8,s.length)) + 1;

		if (num == 2) {
				//get crags
				$.getJSON('?q=list_crags_by_area&area=' + request, function(json) {
					$('#list-crags').html(cragTmpl(json));
					$('#section-2 a').click(function(){
						showNextPanel($(this));
					});
				});
			}
		if (num == 3) {
			//get routes
			$.getJSON('?q=list_routes_by_crag&crag=' + request, function(json) {
				$('#list-routes').html(routeTmpl(json));
				$('#section-3 a').click(function(){
					showNextPanel($(this));
				});
			});
		}
		if (num == 4) {
			//get routes
			$.getJSON('?q=list_route_details&route=' + request, function(json) {
				$('#route-details').html(detailTmpl(json));
			});
		}


		//adjust button state
		if (num > 1) {
			$('li a').removeClass('secondary').removeClass('disabled');
		}
		
		$('#panels').attr('class','section-' + num);

	}

	function showPreviousPanel(section) {
		
		var s = $('#panels').attr('class');
		var num = Number(s.substring(8,s.length)) - 1;

		if (num == 1) {
			$('li a').addClass('secondary').addClass('disabled');
		}
		if (num >= 1) {
			$('#panels').attr('class','section-' + num);
			console.log(num);
		}
		return false;

	}


	$('a.back-panel').click(showPreviousPanel);


</script>

