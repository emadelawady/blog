<?php
echo "<div class='uk-container'>";

  // Check If Get Request Catid Is Numeric & Get The Integer Value Of It

  $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

  // Select All Data Depend On This ID

  $check = checkItem('ID', 'categories', $catid);

  // If There's Such ID Show The Form

  if ($check > 0) {

    $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");

    $stmt->bindParam(":zid", $catid);

    $stmt->execute();

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

    echo redirectHome($theMsg, 'back');

  } else {

    $theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

    echo redirectHome($theMsg);

  }

echo '</div>';
 ?>
