<?php 


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: base.php class - contains common methods and properties used throughout the application
* 	Uses: none
*/


class BaseModel {


	public function populate() {
		
		foreach (BaseModel::getClassProperties($this) as $prop) {
			$name = $prop->getName();

			if(isset($_REQUEST[$name])) {
				$value = $_REQUEST[$name];
				$this->{$name} = $value;
			}//end if clause					
		}//end of foreach loop
	}//end of populate method



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
	}//end of getClassProperties method
	
}//end of class

?>