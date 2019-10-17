<?php
ob_start(); // output baffering start
session_start();
$pageTitle = "Home Page";
include 'init.php';
global $current_page, $user_info;
// get header
$hook_up->inc_header(); ?>
<div class="container">
  <div class="row">

    <?php
    // arr to store homepage sections title
    $homepage_sec = array('top_rating', 'top_commented', 'latest_posts', 'random_posts');
    // loop through homepage sections
    foreach ($homepage_sec as $sec) { include($hook_up->component($sec, true)); }

    ?>
  </div>
</div>
  <!-- end container -->
  <?php
  $hook_up->inc_footer('main', '-');
  // 'main', '-'
  ob_end_flush(); // Release The Output
?>
