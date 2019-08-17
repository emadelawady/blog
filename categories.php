<?php
session_start();

include 'init.php';
$pageTitle = 'Categories - ' . $_GET['page_title'];
// get header
$hook_up->inc_header(); ?>

<script type="text/javascript">

</script>
<?php // get posts
$rowperpage = array(0,5);
$one = $rowperpage[0];
$two = $rowperpage[1];
$three = $one . ',' . $two;
$posts = get_posts_by('Cat_ID',$_GET['pageid'],$three);
?>
  <div class="cat_title" uk-grid>
    <div class="uk-width-1-1">
    <h1 class="uk-padding-small uk-text-left">
      <span>Categories</span>
       »
    <?php if(!empty($_GET['page_title'])){ echo strtoupper(str_replace( '-', ' ',$_GET['page_title']));} else{
      echo "# Dude just be nice and pick up a category from top menu";
    } ?>
  </h1>
  </div>
  </div>
  <div id="post_ajax" class="uk-container categories uk-margin-auto" uk-grid>

    <?php

      if (!empty($posts)) {

      foreach ($posts as $post) { ?>
      <div class="uk-padding-small uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l">

        <div class="cat-posts uk-border-rounded" style="background-image: url(<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>)">
          <div class="uk-overlay-primary uk-border-rounded">
            <div class="uk-card-header">
              <h3 class="uk-text-capitalize">
                  <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                  <?php echo excerpt_len($post['Name']); ?>
                </a>
                  </h3>
            </div>
            <div class="uk-card-body">
                <p>
                  <?php echo excerpt_len($post['Description'],50, true); ?>
                </p>
            </div>
            <div class="uk-card-footer uk-margin-remove" uk-grid>
              <div class="uk-width-1-2">
                <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-label-success">Read more</a>
              </div>
              <div class="uk-width-1-2">
                <p class="uk-margin-remove-top">
                  <time datetime="2016-04-01T19:00">
                    <?php echo $post['Add_Date']; ?>
                  </time>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        echo "There's No Posts To Show";
      } ?>

  </div>


  <?php $hook_up->inc_footer('main', '-') ?>