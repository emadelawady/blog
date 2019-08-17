<div>
<h4>Latest Posts</h4>
<?php $latest_comments = get_latest('*', 'posts', 'Post_ID', 5);
echo '<ul>';
foreach ($latest_comments as $latest) {
  echo '<li><a href="posts.php?postid='.$latest['Post_ID'].'">'. $latest['Name'] .'</a></li>';
}
echo '</ul>';
 ?>
</div><!--End Latest Posts -->
<div>
<h4>Latest Registered Users</h4>
<?php $latest_users = get_latest('*', 'users', 'UserID', 5);
echo '<ul>';
foreach ($latest_users as $latest_user) {
echo '<li><a href="profile.php">'. $latest_user['Username'] .'</a></li>';
}
echo '</ul>';
?>
</div><!--End Latest Users -->
