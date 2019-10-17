<?php
session_start();

include 'init.php';
$pageTitle = 'أقسام - ' . $_GET['page_title'];
// get header
$hook_up->inc_header();

$page_id = isset($_GET['pageid']) ? $_GET['pageid'] : "";

 // get posts
  require_once 'pagination-class.php';
  $pagination =  new Pagination('posts');
  $posts = $pagination->get_data($page_id);
?>
  <div class="row cat_title">
    <div class="col-sm-12">
    <h1 class="text-right">
      <span>أقسام » </span>

    <?php if(!empty($_GET['page_title'])){ echo strtoupper(str_replace( '-', ' ',$_GET['page_title']));} else{
      echo "# Dude just be nice and pick up a category from top menu";
    } ?>
  </h1>
  <div class="hold_sub_cats">
      <ul cless="child_cat">
      <?php
      $top_nav_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC', 4);

        foreach ($top_nav_cat as $cat) {
if ($page_id == $cat['ID'] ) {
      $down_nav_cat = get_all_rec("*", "sub_categories", "category_id = {$cat['ID']}", "id_sub DESC", 4);


      foreach ($down_nav_cat as $down) {
        ?>
      <li>
        <?php
        echo "<a href='categories.php?sub_cat=".$down['id_sub']."&page_title=".str_replace(' ', '-', $down['name_sub'])."'>";
          echo $down['name_sub'];
        echo "</a>"; ?>
      </li>
    <?php   }
  }
    } ?>
    </ul>
  </div>
  </div>
  </div>
  <div class="container">
  <div id="post_ajax" class="row categories">

    <?php


      if (!empty($posts)) {

      foreach ($posts as $post) {
        ?>

      <div class="col-sm-12 col-md-4 col-lg-4 hovereffect">

          <span class="img-responsive img_span" style="background-image: url('<?php echo empty($post->Image) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post->Image;?>')" alt="">
          </span>
          <div class="overlay">
            <div class="post_title_cat">
              <h2>
                <a id="<?php echo $post->Post_ID; ?>" href="posts.php?postid=<?php echo $post->Post_ID; ?>" class="checkActive">
                <?php echo excerpt_len($post->Name); ?>
              </a>
              </h2>
            </div>
            <div class="">
                <p>
                  <?php echo excerpt_len($post->Description,50, true); ?>
                </p>
            </div>
            <div class="date">
              <span class="">
                <?php echo date("M Y", strtotime($post->Add_Date));?>
              </span>
            </div>
            <div class="top_commented">
              <span>
                <?php echo $post->Rating . ' ' . "<i class='fas fa-star' style='font-size:11px !important;'></i>"; ?>
              </span>
            </div>
          </div>
      </div>
      <?php
        }
      } else {
        echo "There's No Posts To Show";
      } ?>

  </div>
</div>
<?php if (!empty($posts)) { ?>
<div class="cat_pagi row">
  <ul class="col-sm-12 col-md-12">
<?php
    $pages  = $pagination->get_pagination_number($_GET['pageid']);

    $curr  = $pagination->current_page();
    foreach ($pages as $page) {
      $count = ceil($page['count'] / $pagination->limit);

   for($i = 1; $i<$count; $i++){
     ?>
     <li class="<?php echo $i == $curr ? "activePag" : ""; ?>">

        <a href="categories.php?pageid=<?php echo isset($_GET['pageid']) ? $_GET['pageid'] : ""; ?>&page_title=<?php echo $_GET['page_title']; ?>&page=<? echo $i;?>">
          <?php echo $i; ?>
        </a>
      </li>
<?php }
    }
?>
  </ul>
</div>
<?php } ?>
  <?php $hook_up->inc_footer('main', '-') ?>
