<?php
ob_start(); // output baffering start
session_start();
$tags_page = isset($_GET['tags']) ? $_GET['tags'] : '';
$pageTitle = $tags_page;
include 'init.php';
global $current_page, $user_info;
// get header
$hook_up->inc_header();
$new_tag = "tags LIKE '%$tags_page%'";
$posts = get_all_rec("*", "posts", $new_tag, 'Post_ID DESC');
//$posts = get_posts_by('Cat_ID',$_GET['pageid'], true);

if ($tags_page) { ?>
  <h1><?php echo $_GET['tags']; ?></h1>

  <div class="uk-child-width-1-2@m  uk-child-width-1-3@l uk-text-center" uk-grid>
    <?php
    if (!empty($posts)) {
    foreach ($posts as $post) { ?>
      <div class="">
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
              <p><?php echo excerpt_len($post['Description'],300, true); ?></p>
          </div>
          <div class="uk-card-footer uk-margin-remove" uk-grid>
            <div class="uk-width-1-2">
              <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-alert-danger">Read more</a>
            </div>
            <div class="uk-width-1-2">
              <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00"><?php echo $post['Add_Date']; ?></time></p>
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      echo "There's No Posts To Show";
    } ?>
  </div>

<?php } else{
  echo "You Must Enter The Tag Name";
} ?>

<?php
 $hook_up->inc_footer();
 // 'main', '-'
 ob_end_flush(); // Release The Output
?>
