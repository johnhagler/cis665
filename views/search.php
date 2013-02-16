<div class="row">
	<div class="twelve columns panel radius">
		<h1>FindIt!</h1>
	</div>
</div>

<div class="row">
    <div class="twelve columns">
        <span class="label round">Search</span>
        <span class="label round secondary"><a href="?q=browse" style="color:#666;">Browse</a></span>
    </div>
</div>

<div class="row">

	<div class="three columns">
		<h3>Search</h3>
        <form action="#">
            <div class="row collapse">
              <div class="nine mobile-three columns">
                <input type="text" />
              </div>
              <div class="three mobile-one columns">
                <a class="button expand postfix">Search</a>
              </div>
            </div>
        </form>
	</div>

	<div class="nine columns">
		<?php include 'templates/list_routes.php'; ?>
		<table id="routes" class="twelve" style="margin-top:14px;">
		</table>
	</div>

</div>


<?php include 'templates/route_details.php'; ?>

<div class="row">
    <div class="twelve columns">
        <div id="route-details"></div>      
    </div>
</div>
    

<script>
  $(window).load(function() {
    $("#route-details").joyride({
      /* Options will go here */
    });
  });
</script>



<script>
    var detailTmpl = Handlebars.compile($("#route-details-template").html());
    function showRouteDetails(route) {
        $.getJSON('?q=list_route_details&route=' + route, function(json) {
            $('#route-details').html(detailTmpl(json));
        });
    }
</script>





<script type="text/javascript">

    var data = {};
    var rowsTmpl;
    var colsTmpl;
    $.getJSON('?q=list_routes', function(json) {
        data = json;
        
    
        rowsTmpl = Handlebars.compile($("#rows").html());
        colsTmpl = Handlebars.compile($("#cols").html());

        $('#routes').append(colsTmpl(data));
        $('#routes').append(rowsTmpl(data));

        $("#routes th a[data-sortby]").click(function (){
            sortTable(this);
        });
        
        $("#routes td a").click(function (){
            showRouteDetails($(this).html());
        });

    });
    

    function sortTable(name) {
        var sortby = "";
        if ($(name).hasClass("foundicon-up-arrow")) {
            $(name).removeClass("foundicon-up-arrow").addClass("foundicon-down-arrow");
            sortby = "-";
        } else {
            $(name).removeClass("foundicon-down-arrow").addClass("foundicon-up-arrow");
        }

        $("#routes th a").not(name).removeClass("foundicon-up-arrow").removeClass("foundicon-down-arrow");

        var col = $(name).data("sortby");
        var sortStyle = $(name).data("sort-style");

        
        if (sortStyle == 'alpha') {
            data.rows = _.sortBy(data.rows, string_comparator(sortby + col));
        } else if (sortStyle == 'numeric') {
            data.rows = _.sortBy(data.rows, number_comparator(sortby + col));
        }
        
        // remove all table rows
        $("#routes tr>td").parent().remove();

        $("#routes").append(rowsTmpl(data));

        $("#routes td a").click(function (){
            showRouteDetails($(this).html());
        });
        
    }


</script>