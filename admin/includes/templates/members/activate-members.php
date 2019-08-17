<?php
echo "<div class='uk-container'>";

  // Check If Get Request userid Is Numeric & Get The Integer Value Of It

  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

  // Select All Data Depend On This ID

  $check = checkItem('userid', 'users', $userid);

  // If There's Such ID Show The Form

  if ($check > 0) {

    $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");

    $stmt->execute(array($userid));

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

    echo redirectHome($theMsg, 'back');

  } else {

    $theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

    echo redirectHome($theMsg, 'back');

  }

echo '</div>';
 ?>
