<?php global $con, $user_info, $session_user, $current_page; // Global Vars ?>
  <!DOCTYPE html>
  <html lang="ar" dir="rtl">

  <head>
    <meta charset="utf-8">
    <title>
      <?php getTitle(); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <?php
    on_styles('uikit-rtl.min');
    on_scripts('all.min');
    on_styles('bootstrap.min');
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
                  الصفحة الرئيسية
                  <i class="fas fa-home fa-1x"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- End LEFT nav ONE -->

          <!-- Start RIGHT nav ONE -->
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav header_light">
              <li class="<?php if(isset($current_page) && $current_page == 'add-post.php') { echo " active_upper "; } ?>">
                <a href="add-post.php" class="a_header">
                  <i class="fas fa-edit fa-1x"></i>
                  <span class=''> إضافة مقالة</span>
                </a>
              </li>
              <li class="<?php if(isset($current_page) && $current_page == 'profile.php') { echo " active_upper "; } ?>">
                <a href="profile.php">
                  <i class="fas fa-user fa-1x"></i>
                  <span class=''> الملف الشخصى</span>
                </a>
              </li>
              <li class="<?php if(isset($current_page) && $current_page == 'edit-profile.php') { echo " active_upper "; } ?>">
                <a href="edit-profile.php">
                  <i class="fas fa-user-edit fa-1x"></i>
                  <span class=''>تعديل الملف الشخصى</span>
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
        <!-- Start nav two  -->
        <nav class="uk-navbar uk-width-1-1 uk-margin-remove down_nav" uk-navbar>
          <ul class="uk-navbar-nav uk-margin-auto" uk-grid>
            <?php
            $top_nav_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC', 4);

              foreach ($top_nav_cat as $cat) {
                 ?>

                <li class="list_nav uk-padding-remove <?php if(isset($_GET['page_title']) && $_GET['page_title'] == str_replace(' ', '-', $cat['Name'])) { echo "acitveTwo";} ?>">
                   <?php
                  echo "<a class='a_header' href='categories.php?pageid=".$cat['ID']."&page_title=".str_replace(' ', '-', $cat['Name'])."'>";
                    echo $cat['Name'];
                  echo "</a>"; ?>
                </li>
                <?php
                $down_nav_cat = get_all_rec("*", "sub_categories", "category_id = {$cat['ID']}", "id_sub DESC", 4);
                if (!empty($down_nav_cat)) { ?>
                <ul class="child_cat" uk-dropdown>
                <?php
                foreach ($down_nav_cat as $down) { ?>
                <li>
                  <?php
                  echo "<a href='categories.php?pageid=".$down['id_sub']."&page_title=".str_replace(' ', '-', $down['name_sub'])."'>";
                    echo $down['name_sub'];
                  echo "</a>"; ?>
                </li>
            <?php  }  ?>
          </ul>
        <?php } ?>

            <?php } ?>
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
