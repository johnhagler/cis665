<div class="row">
	<div class="twelve columns panel radius">
		<h1>FindIt!</h1>
	</div>
</div>

<div class="row">
	<div class="three columns">
		<h3>search</h3>
	</div>
	<div class="nine columns">
		
		<table id="routes" class="twelve">
			
		</table>

	</div>
</div>

<?php include 'listRoutesTemplates.php'; ?>
<script type="text/javascript" src="javascripts/data.json"></script>
<script type="text/javascript">

    var rowsTmpl = Handlebars.compile($("#rows").html());
    var colsTmpl = Handlebars.compile($("#cols").html());

    $('#routes').append(colsTmpl(data));
    $('#routes').append(rowsTmpl(data));

    $("#routes th a[data-sortby]").click(function (){

        sortTable(this);

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

    }
</script>