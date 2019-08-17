<?php

			echo "<div class='uk-container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$commid = isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('c_id', 'comments', $commid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zcomment");

					$stmt->bindParam(":zcomment", $commid);

					$stmt->execute();

					$theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Post Deleted</div>';

					echo redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

					echo redirectHome($theMsg);

				}

			echo '</div>';
 ?>
