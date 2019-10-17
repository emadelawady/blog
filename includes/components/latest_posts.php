<div class="col-sm-12">


<div class="text-left col-sm-12">

<span class="home_title">
  مضافا حديثاً
   <i class="fas fa-sync-alt homepage_icon"></i></span>
</div>
<div class="row text-left col-sm-12">
<?php
$cat_state = $con->prepare("SELECT
                  categories.ID,categories.Name as cat_name, categories.Description as cat_desc, posts.* FROM posts
                 INNER JOIN categories ON posts.Cat_ID = categories.ID
                 ORDER BY Post_ID DESC LIMIT 4");

$cat_state->execute();
$the_cat = $cat_state->fetchALL();

foreach ($the_cat as $post) {
?>
<div class="col-sm-12 col-md-6 col-lg-3 hovereffect">



  <span class="img-responsive img_span" style="background-image: url('<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>')" alt="">
  </span>

  <div class="overlay">
    <div class="post_title_cat">
      <h2>
       <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
          <?php echo excerpt_len($post['Name']); ?>
        </a>
      </h2>
    </div>
    <div class="">
        <p>
          <?php echo excerpt_len($post['Description'],50, true); ?>
        </p>
    </div>
    <div class="date">
      <span class="">
        <?php echo date("M Y", strtotime($post['Add_Date']));?>
      </span>
    </div>
    <div class="top_commented">
      <span>
        <?php echo $post['Rating'] . ' ' . "<i class='fas fa-star' style='font-size:11px !important;'></i>"; ?>
      </span>
      <span>
        <?php echo $post['cat_name']; ?>
      </span>
    </div>
  </div>

</div>

<?php } ?>

</div>

</div>
