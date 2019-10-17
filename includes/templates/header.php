<?php global $user_info, $session_user, $current_page; // Global Vars ?>
  <!DOCTYPE html>
  <html lang="ar" dir="rtl">

  <head>
    <meta charset="utf-8">
    <title>
      <?php getTitle(); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <?php

    $arr = array('bootstrap.min', 'animate.min', 'bootstrap-hover-dropdown.min', 'slicknav-min', 'main-rtl', 'media_query');
    foreach ($arr as $val) {
      on_styles($val);
    } ?>
  </head>

  <body>
    <header class="front_header row sticky-top" data-spy="affix" data-offset-top="50">
      <?php if(isset($_SESSION['user'])) {

        // logged in user will see this part
        include 'includes/templates/headers/main/logged-in.php';
       } else{
         include 'includes/templates/headers/main/logged-out.php';
       } ?>
        <!-- end nav two -->
    </header>
