<script id="cols" type="text/x-handlebars-template">
<tr>
{{#columns}}
    <th><a href="#" 
    		data-sortby="{{name}}" 
    		data-sort-style="{{sortStyle}}"
    		class="">{{title}}</a></th>
{{/columns}}
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
</tr>
{{/rows}}
</script>