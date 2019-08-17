<?php
echo "<div class='uk-container'>";

  // Check If Get Request userid Is Numeric & Get The Integer Value Of It

  $commid = isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']) : 0;

  // Select All Data Depend On This ID

  $check = checkItem('c_id', 'comments', $commid);

  // If There's Such ID Show The Form

  if ($check > 0) {

    $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");

    $stmt->execute(array($commid));

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Comment Approved</div>';

    echo redirectHome($theMsg, 'back');

  } else {

    $theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

    echo redirectHome($theMsg, 'back');

  }

echo '</div>';
 ?>
