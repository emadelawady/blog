<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  echo "<div class='uk-container'>";

  // Get Variables From The Form

  $name 		= $_POST['name'];
  $desc 		= $_POST['description'];
  $parent 	= $_POST['parent'];
  $order 		= $_POST['ordering'];
  $visible 	= $_POST['visibility'];
  $comment 	= $_POST['commenting'];
  $ads 		= $_POST['ads'];

  // Check If Category Exist in Database

  $check = checkItem("Name", "categories", $name);

  if ($check == 1) {

    $theMsg = '<div class="uk-alert uk-alert-danger">Sorry This Category Is Exist</div>';

    echo redirectHome($theMsg, 'back');

  } else {

    // Insert Category Info In Database

    $stmt = $con->prepare("INSERT INTO

      categories(Name, Description, parent , Ordering, Visibility, Allow_Comment, Allow_Ads)

    VALUES(:zname, :zdesc, :zparent, :zorder, :zvisible, :zcomment, :zads)");

    $stmt->execute(array(
      'zname' 	=> $name,
      'zdesc' 	=> $desc,
      'zparent' => $parent,
      'zorder' 	=> $order,
      'zvisible' 	=> $visible,
      'zcomment' 	=> $comment,
      'zads'		=> $ads
    ));

    // Echo Success Message

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

      echo redirectHome($theMsg, 'back');

  }

} else {

  echo "<div class='uk-container'>";

  $theMsg = '<div class="uk-alert uk-alert-danger">Sorry You Cant Browse This Page Directly</div>';

  echo redirectHome($theMsg, 'back');

  echo "</div>";

}

echo "</div>";

 ?>
