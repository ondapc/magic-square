<?php
// ERRORS
ini_set("memory_limit","1024M");
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0); // NO TIME LIMIT

// MYSQL CONNECTION PARAMS
define('DB_HOST', 'localhost'); 
define('DB_USER', 'ondapc'); 
define('DB_PASS', 'sevilla1'); 
define('DB_NAME', 'PERMUTATIONS'); 

$grid = (isset($_REQUEST['grid']) && $_REQUEST['grid']) ? $_REQUEST['grid'] : '3';
$grid = intval($grid);

if ( $grid > 30 ) {
	$grid = 30;
} else {
	$grid = $grid;
}

require_once('functions.php');
?>
