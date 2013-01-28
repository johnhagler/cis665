CIS665 - PHP Project
======
Built on a custom micro MVC framework.

#Request Handling
All requests are routed through index.php on the root folder.  This requires the application/core.php file which instantiates the Controller class defined in application/controller.php.  The controller is the request handling is done.  Requests types are parsed by a parameter named "q".  For example "?q=planit" will route to the "PlannIt" page.  Within the controller, a function is called to make any necessary model calls to get data required for the view.  The application/load.php handles the routing to the view php page.  At this step, a header and footer is included with the view.


#Data Requirements

##Home

###Unsecured

###Secured

* New climbs in your area
* My stats summary

##FindIt

###Unsecured

* Initial search
