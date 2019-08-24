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
    <?php
      include $components . 'top_rating.php';
      include $components . 'latest_posts.php';
      include $components . 'top_commented.php';
      include $components . 'random_posts.php';
    ?>
  </div>
</div>
  <!-- end container -->
  <?php
  $hook_up->inc_footer('main', '-');
  // 'main', '-'
  ob_end_flush(); // Release The Output
?>
