<?php
include 'init.php';

$row = $_POST['row'];
$rowperpage = 3;

$ddd = $row . ',' , $rowperpage;
$posts = get_posts_by('Cat_ID',$_GET['pageid'], $ddd);


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
  }
}?>
