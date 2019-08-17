<?php
ob_start(); // Output Buffering Start

session_start();
$pageTitle = 'Dashbaord';
if (isset($_SESSION['Username']) && $_GET['adminPanel'] == 'Manage-dash') {
  include 'init.php';

  $adminPanel = isset($_GET['adminPanel']) ? $_GET['adminPanel'] : 'Manage';

  ?>

    <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
      <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
          <?php	include $templates . 'sidebar.php'; ?>
      </div>
      <div class="uk-width-5-6 uk-padding-remove otherBackground">
        <?php
        if ($adminPanel == 'Manage-dash') {

          $numUsers = 6; // Number Of Latest Users

          $latestUsers = get_latest("*", "users", "UserID", $numUsers); // Latest Users Array

          $numPosts = 6; // Number Of Latest Items

          $latestPosts = get_latest("*", 'posts', 'Post_ID', $numPosts); // Latest Items Array

           ?>
          <div class=" uk-container">
            <?php
              // show alert on dashboard
              alert_on('dashboard.php', 'Dashbaord'); ?>
          <div class="uk-card uk-card-default uk-padding-remove">
            <div class="uk-card-header uk-flex uk-flex-row-reverse uk-flex-middle">
              <div>
                <h3 class="uk-card-title uk-margin-remove MainColor">
                  <i class="fas fa-air-freshener fa-1x"></i>
                  Latest Members & Posts
                </h3>
              </div>
            <buton class="uk-button uk-label toggle-info MainBack">
              <i class="fas fa-minus fa-1x"></i>
            </buton>
          </div>
          <?php
          include $includes . 'dashboard/latest_members_posts.php';
          include $includes . 'dashboard/latest_comments.php';


           ?>

    </div>
</div>
  		<?php

    		 ?>
      </div>
    </main>
  <?php
  include $templates . 'footer.php';
} else{
  header('Location: index.php');
  exit();
}
}
ob_end_flush(); // Release The Output
