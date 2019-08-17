<?php global $user_info, $session_user, $current_page; // Global Vars ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>
      <?php getTitle(); ?>
    </title>
    <?php
    on_styles('uikit.min');
    on_scripts('all.min');
    // on_styles('bootstrap.min');
    on_styles('main');
    ?>
  </head>

  <body>
    <header class="front_header" uk-grid>
      <?php if(isset($_SESSION['user'])) { ?>

        <!-- Start nav one -->
        <nav class="uk-navbar uk-width-1-1 uk-margin-remove" uk-navbar>

          <!-- Start LEFT nav ONE -->
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li>
                <a href="index.php">
                  <i class="fas fa-home fa-1x"></i> Home Page
                </a>
              </li>
            </ul>
          </div>
          <!-- End LEFT nav ONE -->

          <!-- Start RIGHT nav ONE -->
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li class="<?php if(isset($current_page) && $current_page == 'add-post.php') { echo " active_upper "; } ?>">
                <a href="add-post.php" class="">
                  <i class="fas fa-edit fa-1x"></i>
                  <?php if($current_page == 'add-post.php') { echo "<span class='uk-text-success'> Add Post</span>"; } ?>
                </a>
              </li>
              <li class="<?php if(isset($current_page) && $current_page == 'profile.php') { echo " active_upper "; } ?>">
                <a href="profile.php">
                  <i class="fas fa-user fa-1x"></i>
                  <?php if($current_page == 'profile.php') { echo "<span class='uk-text-success'> Profile</span>"; } ?>
                </a>
              </li>
              <li>
                <a href="logout.php">
                  <i class="fas fa-sign-out-alt fa-1x"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- Start RIGHT nav ONE -->
        </nav>
        <!-- end nav one -->
        <!-- Start nav two  -->
        <nav class="uk-navbar uk-width-1-1 uk-margin-remove sec_background uk-padding-small" uk-navbar>
          <ul class="uk-navbar-nav uk-width-1-1 uk-text-center" uk-grid>
            <!-- Left -->
            <li>
              <a>
                <span class="profile_img">
                <img width="100px" src="admin/uploads/avatars/<?php echo $user_info['avatar']; ?>" alt="">
                </span>
                <span class="uk-text-capitalize">username: <?php echo $user_info['Username']; ?> </span>
              </a>
            </li>
            <!-- Right -->
            <li>
              <a>
                <span class="uk-label">Email</span>
                <span class="uk-alert-primary"><?php echo $user_info['Email']; ?></span>
              </a>
            </li>
            <li>
              <a>
                <span class="uk-label">Status</span>
                <?php if ($user_info['RegStatus'] == 1) {
                  echo "<span class='uk-alert-primary'>Activated</span>";
                } else{
                  echo "<span class='uk-alert-danger'>Not Activated</span>";

                }?>
              </a>
            </li>
          </ul>
        </nav>
        <?php } else{ ?>
          <nav class="uk-navbar uk-width-1-1 uk-margin-remove">
            <div class="uk-navbar-left">
              <ul class="uk-navbar-nav">
                <li>
                  <a href="index.php">
                    <i class="fas fa-home fa-1x"></i> Home Page
                  </a>
                </li>
                <li>
                  <a href="login.php" class="log-sign">
              Login / Sign Up <i class="fas fa-sign-in-alt fa-1x"></i>
            </a>
                </li>
              </ul>
            </div>
            <div class="uk-navbar-right">
              <ul class="uk-navbar-nav">
                <?php
                $categories = get_all_rec('*', 'categories', NULL, 'ID DESC', 6,
                'posts ON posts.Cat_ID = categories.ID');

                foreach ($categories as $cat) { ?>

                  <li class="<?php if(isset($_GET['page_title']) && $_GET['page_title'] == $cat['Name']) { echo " acitveTwo ";} ?>">
                    <?php
              echo "<a href='categories.php?pageid=".$cat['ID']."&page_title=".str_replace(' ', '-', $cat['Name'])."'>";
                echo $cat['Name'];
              echo "</a>"; ?>
                  </li>
                  <?php } ?>
              </ul>
            </div>
          </nav>
          <?php } ?>
            <!-- end nav two -->
    </header>