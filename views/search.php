
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


<<<<<<< HEAD
<!--GENERAL SEARCH
	<div class="three columns">
		<h3>Search</h3>
        <form action="#">
=======
<!--Search Routes by Multiple Criteria-->
<section>
    <div class="three columns">
        <h3>Search Routes</h3>

        <form action="?q=search_routes" method="post" name="search" id="search">

>>>>>>> mass commit
            <div class="row collapse">

                <div class="nine mobile-three columns">
                    <label for ="name">Route</label>
                    <input type="text" name="route" />
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
                    <label for ="grade">Grade</label>
                    <input type="text" name="grade" />
                </div>

                <div class="nine mobile-three columns">
                    <label for ="rating">Rating</label>
                    <input type="text" name="rating" />
                </div>

                <div class="three mobile-one columns">
                  <a class="button expand postfix">Search</a>       
                    <input type="submit" name="search" value="Search"/>   
                </div>
            </div>
        </form>
<<<<<<< HEAD
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


=======
    </div>
</section>

      
>>>>>>> mass commit





<<<<<<< HEAD
</div>
-->
=======

>>>>>>> mass commit

    <div class="nine columns">
        <table id="routes" class="twelve" style="margin-top:14px;">
        </table>
    </div>

</div>

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

    $("form#search").submit(function (){
        var param = $(this).serialize();
        getRouteData(param);
        return false;
    });



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


    
    function getRouteData (param) {
            $.getJSON('?q=search_routes&' + param, function(json) {
                data = json;

            $('#routes').html('');
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