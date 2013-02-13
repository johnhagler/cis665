<?php 

class BaseModel {


	public function populate() {
		
		foreach (BaseModel::getClassProperties($this) as $prop) {
			$name = $prop->getName();
			$value = $_REQUEST[$name];
			$this->{$name} = $value;

		}

	}


	public static function getClassProperties($className, $types='public') { 
	    $ref = new ReflectionClass($className); 
	    $props = $ref->getProperties(); 
	    $props_arr = array(); 
	    foreach($props as $prop){ 
	        $f = $prop->getName(); 
	        
	        if($prop->isPublic() and (stripos($types, 'public') === FALSE)) continue; 
	        if($prop->isPrivate() and (stripos($types, 'private') === FALSE)) continue; 
	        if($prop->isProtected() and (stripos($types, 'protected') === FALSE)) continue; 
	        if($prop->isStatic() and (stripos($types, 'static') === FALSE)) continue; 
	        
	        $props_arr[$f] = $prop; 
	    } 
	    if($parentClass = $ref->getParentClass()){ 
	        $parent_props_arr = BaseModel::getClassProperties($parentClass->getName());//RECURSION 
	        if(count($parent_props_arr) > 0) 
	            $props_arr = array_merge($parent_props_arr, $props_arr); 
	    } 
	    return $props_arr; 
	}
	
}

?>