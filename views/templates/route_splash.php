<script id="routes-template" type="text/x-handlebars-template">
	<ul class="disc">
	{{#routes}}
	    <li>
	        <h5 style="margin:0 0 -8px 0;"><a href="?q=route_details&route={{route}}">{{route}}</a></h5>
	        <p style="margin:0;">{{area}}, {{crag}}</p>
	    </li>
	{{/routes}}
	</ul>
</script>