<?php
// array for pages title in navbar
$pages_title = array(
  'Manage-dash'   => array('fas fa-chart-pie' => 'Website Statistics'),
  // Members Page
  'Add-mem'       => array('fas fa-plus' => 'Add Member'),
  'Edit-mem'       => array('fas fa-edit' => 'Edit Member'),
  'Insert-mem'       => array('fas fa-plus-square' => 'Insert Member'),
  'Update-mem'       => array('fas fa-check' => 'Update Member'),
  'Delete-mem'       => array('fas fa-skull-crossbones' => 'Delete Member'),
  'Activate-mem'       => array('fab fa-studiovinari' => 'Activate Member'),

  // Categories Page
  'Manage-cat'    => array('fab fa-gripfire' => 'Manage Categories'),
  'Add-cat'    => array('fas fa-plus' => 'Add Category'),
  'Edit-cat'    => array('fas fa-edit' => 'Edit Category'),
  'Insert-cat'    => array('fas fa-plus-square' => 'Insert Category'),
  'Update-cat'    => array('fas fa-check' => 'Update Category'),
  'Delete-cat'    => array('fas fa-skull-crossbones' => 'Delete Category'),

  // Posts Page
  'Manage-posts'    => array('fab fa-gripfire' => 'Manage Posts'),
  'Add-posts'    => array('fas fa-plus' => 'Add Post'),
  'Edit-posts'    => array('fas fa-edit' => 'Edit Post'),
  'Insert-posts'    => array('fas fa-plus-square' => 'Insert Post'),
  'Update-posts'    => array('fas fa-check' => 'Update Post'),
  'Delete-posts'    => array('fas fa-skull-crossbones' => 'Delete Post'),
  'Approve-posts'    => array('fas fa-check' => 'Approve Post'),

  // Comments Page
  'Manage-comment'    => array('fab fa-gripfire' => 'Manage comments'),
  'Add-comment'    => array('fas fa-plus' => 'Add Comment'),
  'Edit-comment'    => array('fas fa-edit' => 'Edit Comment'),
  'Insert-comment'    => array('fas fa-plus-square' => 'Insert Comment'),
  'Update-comment'    => array('fas fa-check' => 'Update Comment'),
  'Delete-comment'    => array('fas fa-skull-crossbones' => 'Delete Comment'),
  'Approve-comment'    => array('fas fa-check' => 'Approve Comment')

);
 ?>

<nav class="uk-navbar" uk-navbar>
  <ul class="uk-navbar-nav uk-width-1-1">
    <li>
      <a>
            <?php

          if (isset($_GET['adminPanel']) && !isset($_GET['page']) ) {
            get_nav_title('adminPanel', 'Manage-mem', 'Manage Members', 'fas fa-users');

          } else {

            get_nav_title('page', 'Pending', 'Pending Members', 'fas fa-users');

          }


            //  Scan through outer loop
            foreach ($pages_title as $titleKey => $title) {
                //  Check type
                if (is_array($title)){
                    //  Scan through inner loop
                    foreach ($title as $key => $value) {

                     get_nav_title('adminPanel', $titleKey, $value, $key);

                    }
                }
            }


             ?>
       </a>
    </li>
    <li>
      <a href="../index.php">
        <i class="fas fa-home fa-2x"></i>
          Blog
      </a>
    </li>
    <li>
      <a href="logout.php">
        <i class="fas fa-sign-out-alt fa-2x"></i>
        Log Out
      </a>
    </li>
  </ul>
</nav>
