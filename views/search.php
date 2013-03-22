
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

<section id="search-panel">
<div class="row">
<!--Search Routes by Multiple Criteria-->

    <div class="three columns">
        <h3>Search Routes</h3>

        <form action="?q=search_routes" method="post" name="search" id="search" class="custom">

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
                    <label for ="stonetype">Stone Type</label>
                    <select name="stonetype" id="stonetype">
                        <option value=""></option>
                        <option value="Limestone">Limestone</option>
                        <option value="Sandstone">Sandstone</option>
                    </select>
                </div>

                <div class="nine mobile-three columns">
                    <label for ="grade">Grade</label>
                    <select name="grade" id="grade">
                        <option value=""></option>
                        <option value="5.5">5.5</option>
                        <option value="5.6">5.6</option>
                        <option value="5.7">5.7</option>
                        <option value="5.8">5.8</option>
                        <option value="5.9">5.9</option>
                        <option value="5.9 PG13 ">5.9 PG13 </option>
                        <option value="5.9+ ">5.9+ </option>
                        <option value="5.9-">5.9-</option>
                        <option value="5.10a ">5.10a </option>
                        <option value="5.10a R ">5.10a R </option>
                        <option value="5.10a/b ">5.10a/b </option>
                        <option value="5.10b ">5.10b </option>
                        <option value="5.10c ">5.10c </option>
                        <option value="5.10d ">5.10d </option>
                        <option value="5.11-">5.11-</option>
                        <option value="5.11a ">5.11a </option>
                        <option value="5.11a/b ">5.11a/b </option>
                        <option value="5.11b ">5.11b </option>
                        <option value="5.11c">5.11c</option>
                        <option value="5.11d ">5.11d </option>
                        <option value="5.11d R ">5.11d R </option>
                        <option value="5.12- ">5.12- </option>
                        <option value="5.12a ">5.12a </option>
                        <option value="5.12b ">5.12b </option>
                        <option value="5.12b ">5.12b </option>
                        <option value="5.12c ">5.12c </option>
                        <option value="5.12d ">5.12d </option>
                        <option value="5.13a ">5.13a </option>
                        <option value="5.13a ">5.13a </option>
                        <option value="5.13b">5.13b</option>
                        <option value="5.13b/c ">5.13b/c </option>
                        <option value="5.13c ">5.13c </option>
                    </select>
                </div>

                <div class="nine mobile-three columns">
                    <label for="pitches">Pitches</label>
                    <select name="pitches" id="pitches">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>


                <div class="nine mobile-three columns">
                    <label for ="rating">Rating</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating" />
                </div>

                <div class="nine mobile-one columns">        
                    <input type="submit" name="search" value="Search" class="button button-large even radius">
                    </a>  
                </div>
            </div>
        </form>
    </div>

    <div class="nine columns">
        <table id="routes" class="twelve" style="margin-top:14px;">
        </table>
    </div>

</div>
</section>


<section id="details-panel" style="display:none">

    <div class="row" style="margin-top:1em;">
        <div class="six mobile-four columns">
            <ul class="button-group even two-up">
                <li><a href="#" class="button back-panel">
                    <i class="foundicon-left-arrow"></i>
                </a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="twelve columns">
            <div id="route-details"></div>      
        </div>
    </div>

    <div class="row" style="margin-top:1em;">
        <div class="six mobile-four columns">
            <ul class="button-group even two-up">
                <li><a href="#" class="button back-panel">
                    <i class="foundicon-left-arrow"></i>
                </a></li>
            </ul>
        </div>
    </div>

</section>
    
    


<script>
    
    //ajax search form handler
    $("form#search").submit(function (){
        var param = $(this).serialize();
        getRouteData(param);
        return false;
    });


    //ajax request for route_details template
    var detailTmpl;
    $.get('views/templates/route_details.html', function(data) {
        detailTmpl = Handlebars.compile(data);
    });



    //executing function to get route details
    function showRouteDetails(routeId) {
        $.getJSON('?q=list_route_details&routeId=' + routeId, function(json) {
            $('#route-details').html(detailTmpl(json));
            $('#search-panel').hide();
            $('#details-panel').show();
        });
    }

    $('a.back-panel').click( function (){
        $('#search-panel').show();
        $('#details-panel').hide();
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
                    var routeId = $(this).data('route-id');
                    showRouteDetails(routeId);
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
            data.rows = _.sortBy(data.rows, string_comparator(sortby + col,5));
        } else if (sortStyle == 'numeric') {
            data.rows = _.sortBy(data.rows, number_comparator(sortby + col));
        }
        
        // remove all table rows
        $("#routes tbody").remove();

        $("#routes").append(rowsTmpl(data));

        $("#routes td a").click(function (){
            showRouteDetails($(this).html());
        });
        
    }


</script>