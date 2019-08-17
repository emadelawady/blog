<?php
// the initial file for whole app
include 'connect.php';

// define paths
$includes = 'includes/';

$functions = 'includes/functions/';
$templates = 'includes/templates/';
$css = 'layout/css/';
$js = 'layout/js/';


// include parts
include $functions . 'functions.php';
include $templates . 'header.php';

if (!isset($noNav)) {
  include $templates . 'navbar.php';
}
 ?>
