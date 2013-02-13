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
		
		<table id="routes" class="twelve" style="margin-top:14px;">
			
		</table>

	</div>
</div>


<div id="planRouteModal" class="reveal-modal medium">
  <h2>Sweet, when do you want to do it?</h2>
  <form action="javascript: $('#planRouteModal').trigger('reveal:close');">
      <select name="" id="">
          <option value="">Day Trip - 1/13/2013</option>
          <option value="">Hang out with buddies - 2/26/2013</option>
          <option value="">Only new routes - 3/13/2013</option>
      </select>
      <input type="submit" class="button button medium radius" value="PlanIt!">
  </form>
</div>

<?php include 'templates/list_routes.php'; ?>



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
        addPlanHandler();

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
        addPlanHandler();
    }

    function addPlanHandler() {
        $("a[data-action=planit]").click(function () {
            var id = $(this).data("route-id");
            $(this).addClass("success").html("Planned!");
            $("#planRouteModal").reveal();
            return false;
        });
    }
</script>