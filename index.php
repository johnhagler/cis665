<?php
ini_set( 'display_errors', true );

date_default_timezone_set('America/Los_Angeles');

require_once 'application/controller.php';

$c = new Controller();
$c -> run_app();

?>