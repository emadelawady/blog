<?php
// Check If Get Request userid Is Numeric & Get Its Integer Value

			$commid = isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM comments WHERE c_id = ?");

			// Execute Query

			$stmt->execute(array($commid));

			// Fetch The Data

			$comm = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

        <div class="uk-container">
        	<form  action="?adminPanel=Update-comment" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
            <input type="hidden" name="commid" value="<?php echo $commid ?>" />

        		<!-- Start comment Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
                <span class="uk-label">Post Title</span>
        				<textarea name="comment" class="uk-textarea uk-form-width-large"  placeholder="Comment">
                  <?php echo $comm['comment']; ?>
                </textarea>
        			</div>
        		</div>
        		<!-- End comment Field -->
						<!-- Start Status Field -->
						<div class="uk-margin uk-width-1-1">
							<div class="uk-inline">
									<span>Comments Status</span>
									<select class="uk-form-select uk-select" name="comment-status"  data-uk-form-select>
										<option value="1">Publish</option>
										<option value="0">Draft</option>
									</select>
							</div>
						</div>
						<!-- End Status Field -->

        		<!-- Start Submit Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
        				<input type="submit" value="Update Post" class="uk-button uk-button-primary" />
        			</div>
        		</div>
        		<!-- End Submit Field -->
        	</form>
        </div>

			<?php

			// If There's No Such ID Show Error Message

		} else { ?>

				<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
<?php
				$theMsg = '<div class="uk-alert uk-alert-danger">Theres No Such ID</div>';

				echo redirectHome($theMsg);
?>

				</div>
<?php
			}
 ?>
