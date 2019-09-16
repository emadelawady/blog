<?php
ob_start(); // output baffering start
session_start();
$pageTitle = "Home Page";
include 'init.php';
global $current_page, $user_info;
// get header
$hook_up->inc_header(); ?>
<div class="uk-container  uk-margin">
  <div class="uk-text-center uk-margin uk-margin-auto" uk-grid>
    <div class="uk-text-center uk-width-1-1 no_time">
      <!-- <h1>بدون مناوشات , فقط مقالات حقيقية</h1> -->
    </div>
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
