<?php
echo "<div class='uk-container'>";

  // Check If Get Request userid Is Numeric & Get The Integer Value Of It

  $postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;

  // Select All Data Depend On This ID

  $check = checkItem('Post_ID', 'posts', $postid);

  // If There's Such ID Show The Form

  if ($check > 0) {

    $stmt = $con->prepare("UPDATE posts SET Approve = 1, Status = 1 WHERE Post_ID = ?");

    $stmt->execute(array($postid));

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Post Approved</div>';

    echo redirectHome($theMsg, 'back');

  } else {

    $theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

    echo redirectHome($theMsg, 'back');

  }

echo '</div>';
 ?>
