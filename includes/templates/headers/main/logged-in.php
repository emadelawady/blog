<!-- Start nav one -->
<nav class="row col-sm-12 m-auto navbar nav_in">

  <!-- Start LEFT nav ONE -->
  <div class="col-md-6">
    <ul class="navbar-nav m-auto">
      <li class="list_home">
        <a href="index.php">
          فيلم سوسايتى
          <i class="fab fa-angellist fa-lg"></i>
        </a>
      </li>
    </ul>
  </div>
  <!-- End LEFT nav ONE -->

  <!-- Start RIGHT nav ONE -->
  <div class="col-md-6 down_in">
    <ul class="navbar-nav m-auto header_light header_light_in">
      <li class="<?php if(isset($current_page) && $current_page == 'add-post.php') { echo " active_upper "; } ?>">
        <a href="add-post.php" class="a_header">
          <i class="fas fa-edit fa-1x"></i>
          <span class=''>إضافة</span>
        </a>
      </li>
      <li class="<?php if(isset($current_page) && $current_page == 'profile.php') { echo " active_upper "; } ?>">
        <a href="profile.php">
          <i class="fas fa-user fa-1x"></i>
          <span class=''>البروفايل</span>
        </a>
      </li>
      <li class="<?php if(isset($current_page) && $current_page == 'edit-profile.php') { echo " active_upper "; } ?>">
        <a href="edit-profile.php">
          <i class="fas fa-user-edit fa-1x"></i>
          <span class=''>
            تعديل
          </span>
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
<nav class="navbar navbar-expand-lg col-sm-12 down_nav">
  <ul id="menu" class="row m-auto">

    <?php
    $top_nav_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC', 4);

      foreach ($top_nav_cat as $cat) {
        $down_nav_cat = get_all_rec("*", "sub_categories", "category_id = {$cat['ID']}", "id_sub DESC", 4);

         ?>
        <li class="dropdown <?php if(isset($_GET['page_title']) && $_GET['page_title'] == str_replace(' ', '-', $cat['Name'])) { echo "acitveTwo";} ?>">

           <?php
          echo "<a class='nav-link a_header dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-delay='1000' data-close-others='false' href='categories.php?pageid=".$cat['ID']."&page_title=".str_replace(' ', '-', $cat['Name'])."'>";
          if (!empty($down_nav_cat)) {
            echo $cat['Name'];
          } else {
            echo $cat['Name'];
          }
          echo "</a>"; ?>
          <?php
          if (!empty($down_nav_cat)) { ?>
          <ul class="child_cat dropdown-menu">
          <?php
          foreach ($down_nav_cat as $down) { ?>
          <li class="mega-menu-column text-center">
            <?php
            echo "<a class='' href='categories.php?pageid=".$down['id_sub']."&page_title=".str_replace(' ', '-', $down['name_sub'])."'>";
              echo $down['name_sub'];
            echo "</a>"; ?>
          </li>
          <?php  }  ?>
        </ul>
  <?php } ?>
        </li>


    <?php } ?>
  </ul>
</nav>
