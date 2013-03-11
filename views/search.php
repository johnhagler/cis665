<div class="row">
	<div class="twelve columns panel radius">
		<h1>Find a Route</h1>
	</div>
</div>

<div class="row">
    <div class="twelve columns">
        <span class="label round">Search</span>
        <span class="label round secondary"><a href="?q=browse" style="color:#666;">Browse</a></span>
    </div>
</div>

<div class="row">


<!--GENERAL SEARCH
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
-->


<!--Search Routes by Multiple Criteria-->
    <div class="three columns">
        <h3>Search Routes</h3>

        <form action="search_results.php" method="post" name="search_routes_multi" id="search_routes_multi">

            <div class="row collapse">

                <div class="nine mobile-three columns">
                    <label for ="route_name">Route Name</label>
                    <input type="text" name="route_name" />
                </div>

                <div class="nine mobile-three columns">
                    <label for ="area">Area</label>
                    <input type="text" name="area" />
                </div>

                <div class="nine mobile-three columns">
                    <label for ="crag">Crag</label>
                    <input type="text" name="crag" />
                </div>

                <div class="nine mobile-three columns">
                    <label for ="route_grade">Route Grade</label>
                    <input type="text" name="route_grade" />
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
-->

<?php include 'templates/route_details.php'; ?>

<div class="row">
    <div class="twelve columns">
        <div id="route-details"></div>      
    </div>
</div>
    


<script>
    var detailTmpl;
    $.get('views/templates/route_details.html', function(data) {
        detailTmpl = Handlebars.compile(data);
    });


    function showRouteDetails(route) {
        $.getJSON('?q=list_route_details&routeId=' + route, function(json) {
            $('#route-details').html(detailTmpl(json));
        });
    }
</script>





<script type="text/javascript">

    var data = {};
    var rowsTmpl;
    var colsTmpl;
    
    var loadColsTmpl = $.get('views/templates/list_routes_cols.html', function(data) {
        colsTmpl = Handlebars.compile(data);
    });

    var loadRowsTmpl = loadColsTmpl.pipe(
        function () {
            return (
                $.get('views/templates/list_routes_rows.html', function(data) {
                    rowsTmpl = Handlebars.compile(data);
                })
            );
        }
    );


    loadRowsTmpl.pipe(
        function () {
            $.getJSON('?q=list_routes', function(json) {
                data = json;


                $('#routes').append(colsTmpl(data));
                $('#routes').append(rowsTmpl(data));

                $("#routes th a[data-sortby]").click(function (){
                    sortTable(this);
                });
                
                $("#routes td a").click(function (){
                    showRouteDetails($(this).html());
                });

            });
        }
    );


    
    

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