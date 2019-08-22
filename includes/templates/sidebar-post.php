<div class="latest_posts">
<h4>Latest Posts</h4>
<?php $latest_comments = get_latest('*', 'posts', 'Post_ID', 5); ?>
<ul>
  <?php foreach ($latest_comments as $latest) { ?>
  <li>
    <a href="posts.php?postid='.$latest['Post_ID'].'">
      <?php echo $latest['Name']; ?>
    </a>
  </li>
<?php } ?>
</ul>
</div><!--End Latest Posts -->
<div class="latest_users">
<h4>Latest Users</h4>
<?php $latest_users = get_latest('*', 'users', 'UserID', 5);
echo '<ul>';
foreach ($latest_users as $latest_user) {
echo '<li><a href="profile.php">'. $latest_user['Username'] .'</a></li>';
}
echo '</ul>';
?>
</div><!--End Latest Users -->
