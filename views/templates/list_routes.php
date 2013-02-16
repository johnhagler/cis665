
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
    <td>{{stoneType}}</td>
    <td><a href="#route-details">{{route}}<a href="#"></td>
    <td class="text-center">{{approachTime}}</td>
</tr>
{{/rows}}
</script>