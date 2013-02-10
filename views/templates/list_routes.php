
<script id="cols" type="text/x-handlebars-template">
<tr>
{{#cols}}
    <th><a href="#" 
    		data-sortby="{{name}}" 
    		data-sort-style="{{sortStyle}}"
    		class="">{{title}}</a></th>
{{/cols}}
</tr>
</script>

<script id="rows" type="text/x-handlebars-template">
{{#rows}}
<tr>
    <td>{{area}}</td>
    <td>{{crag}}</td>
    <td>{{route}}</td>
    <td>{{stoneType}}</td>
    <td class="text-center">{{approachTime}}</td>
    <td><a href="#" 
            data-route-id="{{routeId}}" 
            data-action="planit"
            class="button tiny radius">PlanIt!</a></td>
</tr>
{{/rows}}
</script>