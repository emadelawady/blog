<?php global $con, $user_info, $session_user, $current_page; // Global Vars ?>
  <!DOCTYPE html>
  <html lang="ar" dir="rtl">

  <head>
    <meta charset="utf-8">
    <title>
      <?php getTitle(); ?>
    </title>
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <?php
    on_styles('uikit-rtl.min');
    on_scripts('all.min');
    // on_styles('bootstrap.min');
    on_styles('main-rtl');
    ?>
  </head>

  <body>
    <header class="front_header" uk-sticky uk-grid>
      <?php if(isset($_SESSION['user'])) { ?>

        <!-- Start nav one -->
        <nav class="uk-navbar uk-width-1-1 uk-margin-remove" uk-navbar>

          <!-- Start LEFT nav ONE -->
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li>
                <a class="home_up" href="index.php">
                  فيلم سوسايتى
                  <i class="fas fa-home fa-1x"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- End LEFT nav ONE -->

          <!-- Start RIGHT nav ONE -->
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li class="<?php if(isset($current_page) && $current_page == 'add-post.php') { echo " active_upper "; } ?>">
                <a href="add-post.php" class="a_header">
                  <i class="fas fa-edit fa-1x"></i>
                  <?php if($current_page == 'add-post.php') { echo "<span class=''> Add Post</span>"; } ?>
                </a>
              </li>
              <li class="<?php if(isset($current_page) && $current_page == 'profile.php') { echo " active_upper "; } ?>">
                <a href="profile.php">
                  <i class="fas fa-user fa-1x"></i>
                  <?php if($current_page == 'profile.php') { echo "<span class=''> Profile</span>"; } ?>
                </a>
              </li>
              <li>
                <a class="home_up" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-1x"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- Start RIGHT nav ONE -->
        </nav>
        <!-- end nav one -->
        <!-- Start nav two  -->
        <nav class="uk-navbar uk-width-1-1 uk-margin-remove down_nav" uk-navbar>
          <ul class="uk-navbar-nav uk-width-1-1 uk-text-center" uk-grid>
            <!-- Right -->
            <li class="profile_email">
              <a>
                <span class="uk-text-capitalize">username: <?php echo $_SESSION['user']; ?> </span>
              </a>
            </li>
            <li class="profile_email">
              <a>
                <span class="">Email</span>
                <span class=""><?php echo $user_info['Email']; ?></span>
              </a>
            </li>
            <li class="profile_email">
              <a>
                <span class="">Status</span>
                <?php if ($user_info['RegStatus'] == 1) {
                  echo "<span class=''>Activated</span>";
                } else{
                  echo "<span class='uk-label-danger'>Not Activated</span>";

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
