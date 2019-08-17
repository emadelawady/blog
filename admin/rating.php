<form class="" action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
  <!-- Start Status Field -->
  <div class="uk-margin-small uk-width-1-1">
    <div class="uk-block">
      <label class="uk-label">Rating</label>
      <select name="rating">
        <option value="0">...</option>
        <option value="1">1 *</option>
        <option value="2">2 **</option>
        <option value="3">3 ***</option>
        <option value="5">4 ****</option>
        <option value="5">5 *****</option>
      </select>
    </div>
  </div>
    <!-- End Status Field -->
    <input type="submit" name="" value="submit">
</form>
<?php
// define variables and set to empty values
$rate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
global $con;

  $rate = $_POST["rating"];
  echo $rate;
 // Insert Category Info In Database

    $statement = $con->prepare("INSERT INTO
      rate(rating)

    VALUES(:zrate)");

    $statement->execute(array('zrate' => $rate ));

    // Echo Success Message

    $theMsg = "<div class='uk-alert uk-alert-success'>" . $statement->rowCount() . ' Record Inserted</div>';
    echo $theMsg;

  }
?>
