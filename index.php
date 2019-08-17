<?php
ob_start(); // output baffering start
session_start();
$pageTitle = "Home Page";
include 'init.php';
global $current_page, $user_info;
// get header
$hook_up->inc_header(); ?>

  <div class="uk-container uk-margin">
    <div class="uk-text-center" uk-grid>
    <?php
    $Iphone = get_all_rec(
      'posts.*, categories.ID, categories.Name AS cat_name', 'posts, categories',
      'categories.Name = "Iphone" AND Status = 1',
      'Post_ID DESC',
      1);

  foreach ($Iphone as $post) { ?>
        <div class="hp_post uk-card uk-card-default uk-width-1-1@s uk-width-2-3@m  uk-width-2-3@l"
            style="background-image: url(<?php echo 'admin/uploads/posts/' . empty($row['Image']) ? 'user.jpg' : $post['Image'];?>)" >
          <div class="uk-card-header sec_background uk-light">
            <div class="uk-grid-small uk-flex-middle" uk-grid>

              <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom">
                    <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                    <?php echo excerpt_len($post['Name']); ?>
                  </a>

                  </h3>
              </div>
            </div>
          </div>
          <div class="uk-card-body">
            <p>
              <?php echo excerpt_len($post['Description'],60, true); ?>
            </p>
          </div>
          <div class="uk-card-footer uk-margin-remove" uk-grid>
            <div class="uk-width-1-3">
              <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-alert-danger">Read more</a>
            </div>
            <div class="uk-width-1-3">
              <p class="uk-text-meta uk-margin-remove-top">
                <time datetime="2016-04-01T19:00">
                  <?php echo $post['Add_Date']; ?>
                </time>
              </p>
            </div>
            <div class="uk-width-1-3">
              <a href="categories.php?pageid=<?php echo $post['ID']; ?>&page_title=<?php echo $post['cat_name'] ?>" class="uk-text-meta uk-margin-remove-top">
                  <?php echo $post['cat_name']; ?>
              </a>
            </div>
          </div>
        </div>
        <?php }

 $Techno = get_all_rec(
   'posts.*, categories.ID, categories.Name AS cat_name', 'posts, categories',
   'categories.ID = 6 AND posts.Cat_ID = 6 AND Status = 1',
   'Post_ID DESC',
   1
 );

foreach ($Techno as $post) { ?>
     <div class="hp_post uk-card uk-card-default uk-width-1-1@s uk-width-1-3@m  uk-width-1-3@l" style="background-image: url(<?php echo 'admin/uploads/posts/' . empty($post['Image']) ? 'user.jpg' : $post['Image'];?>)">
       <div class="uk-card-header sec_background uk-light">
         <div class="uk-grid-small uk-flex-middle" uk-grid>

           <div class="uk-width-expand">
             <h3 class="uk-card-title uk-margin-remove-bottom">
                 <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                 <?php echo excerpt_len($post['Name']); ?>
               </a>

               </h3>
           </div>
         </div>
       </div>
       <div class="uk-card-body">
         <p>
           <?php echo excerpt_len($post['Description'],60, true); ?>
         </p>
       </div>
       <div class="uk-card-footer uk-margin-remove" uk-grid>
         <div class="uk-width-1-3">
           <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-alert-danger">Read more</a>
         </div>
         <div class="uk-width-1-3">
           <p class="uk-text-meta uk-margin-remove-top">
             <time datetime="2016-04-01T19:00">
               <?php echo $post['Add_Date']; ?>
             </time>
           </p>
         </div>
         <div class="uk-width-1-3">
           <a href="categories.php?pageid=<?php echo $post['ID']; ?>&page_title=<?php echo $post['cat_name'] ?>" class="uk-text-meta uk-margin-remove-top">
               <?php echo $post['cat_name']; ?>
           </a>
         </div>
       </div>
     </div>
     <?php }
     $Cinema = get_all_rec(
       'posts.*, categories.ID, categories.Name AS cat_name', 'posts, categories',
       'categories.ID = 5 AND posts.Cat_ID = 5 AND Status = 1',
       'Post_ID DESC',
       3
     );

    foreach ($Cinema as $post) { ?>
         <div class="hp_post uk-card uk-card-default uk-width-1-1@s uk-width-1-3@m  uk-width-1-3@l" style="background-image: url(<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>)">
           <div class="uk-card-header sec_background uk-light">
             <div class="uk-grid-small uk-flex-middle" uk-grid>

               <div class="uk-width-expand">
                 <h3 class="uk-card-title uk-margin-remove-bottom">
                     <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                     <?php echo excerpt_len($post['Name']); ?>
                   </a>

                   </h3>
               </div>
             </div>
           </div>
           <div class="uk-card-body">
             <p>
               <?php echo excerpt_len($post['Description'],60, true); ?>
             </p>
           </div>
           <div class="uk-card-footer uk-margin-remove" uk-grid>
             <div class="uk-width-1-3">
               <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-alert-danger">Read more</a>
             </div>
             <div class="uk-width-1-3">
               <p class="uk-text-meta uk-margin-remove-top">
                 <time datetime="2016-04-01T19:00">
                   <?php echo $post['Add_Date']; ?>
                 </time>
               </p>
             </div>
             <div class="uk-width-1-3">
               <a href="categories.php?pageid=<?php echo $post['ID']; ?>&page_title=<?php echo $post['cat_name'] ?>" class="uk-text-meta uk-margin-remove-top">
                   <?php echo $post['cat_name']; ?>
               </a>
             </div>
             </div>
         </div>
         <?php }
    ?>
    </div>
  </div>
  <!-- end container -->
  <?php
  $hook_up->inc_footer();
  // 'main', '-'
  ob_end_flush(); // Release The Output
?>
