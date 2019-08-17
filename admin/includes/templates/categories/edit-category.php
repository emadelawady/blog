<?php
// Check If Get Request catid Is Numeric & Get Its Integer Value

$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

// Select All Data Depend On This ID

$stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");

// Execute Query

$stmt->execute(array($catid));

// Fetch The Data

$cat = $stmt->fetch();

// The Row Count

$count = $stmt->rowCount();

// If There's Such ID Show The Form

if ($count > 0) { ?>

  <div class="uk-container">
    <form action="?adminPanel=Update-cat" method="POST">
      <input type="hidden" name="catid" value="<?php echo $catid ?>" />
      <!-- Start Name Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Category Name</label>
          <input type="text" name="name" class="uk-input" required="required" placeholder="Category Name" value="<?php echo $cat['Name'] ?>" />
        </div>
      </div>
      <!-- End Name Field -->
      <!-- Start Description Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Description</label>
          <input type="text" name="description" class="uk-input" placeholder="Category Description"  value="<?php echo $cat['Description'] ?>" />
        </div>
      </div>
      <!-- End Description Field -->
      <!-- Start Ordering Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Ordering</label>
          <input type="text" name="ordering" class="uk-input" placeholder="Category Ordering"  value="<?php echo $cat['Ordering'] ?>" />
        </div>
      </div>

      <!-- Start Category Type -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <div class="uk-form-select" data-uk-form-select>
            <span>Parent ?</span>
            <select name="parent">
              <option value="0">....</option>
            <?php
            $patents = get_all_rec('*', 'categories', 'parent = 0');
            foreach ($patents as $parent) { ?>
              echo '
                <option value="<?php echo $parent['ID']; ?>"
                  <?php if ($cat['parent'] == $parent['ID']) {
                  echo 'selected';
                } ?>>
                <?php echo $parent['Name']; ?>
              </option>
              <?php
            }
             ?>
           </select>
          </div>
        </div>
      </div>
      <!-- End Category Type -->


      <!-- Start Visibility Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Visible</label>
          <div>
            <input id="vis-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility'] == 0) { echo 'checked'; } ?> />
            <label for="vis-yes">Yes</label>
          </div>
          <div>
            <input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility'] == 1) { echo 'checked'; } ?> />
            <label for="vis-no">No</label>
          </div>
        </div>
      </div>
      <!-- End Visibility Field -->
      <!-- Start Commenting Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Allow Commenting</label>
          <div>
            <input id="com-yes" type="radio" name="commenting" value="0" <?php if ($cat['Allow_Comment'] == 0) { echo 'checked'; } ?> />
            <label for="com-yes">Yes</label>
          </div>
          <div>
            <input id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment'] == 1) { echo 'checked'; } ?> />
            <label for="com-no">No</label>
          </div>
        </div>
      </div>
      <!-- End Commenting Field -->
      <!-- Start Ads Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <label class="uk-label">Allow Ads</label>
          <div>
            <input id="ads-yes" type="radio" name="ads" value="0" <?php if ($cat['Allow_Ads'] == 0) { echo 'checked'; } ?>/>
            <label for="ads-yes">Yes</label>
          </div>
          <div>
            <input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat['Allow_Ads'] == 1) { echo 'checked'; } ?>/>
            <label for="ads-no">No</label>
          </div>
        </div>
      </div>
      <!-- End Ads Field -->
      <!-- Start Submit Field -->
      <div class="uk-margin-small uk-width-1-1">
        <div class="uk-block">
          <input type="submit" value="Save" class="uk-button uk-button-primary" />
        </div>
      </div>
      <!-- End Submit Field -->
    </form>
  </div>

<?php

// If There's No Such ID Show Error Message

} else {

  echo "<div class='container'>";

  $theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';

  echo redirectHome($theMsg);

  echo "</div>";

}
 ?>
