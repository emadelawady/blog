
<?php
  		$sort = 'asc';

			$sort_array = array('asc', 'desc');

			if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {

				$sort = $_GET['sort'];

			}

			$stmt2 = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");

			$stmt2->execute();

			$cats = $stmt2->fetchAll();

			if (! empty($cats)) { ?>
				<div class="uk-container categories">
					<div class="uk-card uk-card-default uk-card-body">
						<div class="uk-card-title">
							<span uk-icon="hashtag"></span> Manage Categories
							<div class="option uk-float-right">
								Ordering <span uk-icon="triangle-down"></span>  [
								<a class="<?php if ($sort == 'asc') { echo 'active'; } ?>" href="?sort=asc">Asc</a> |
								<a class="<?php if ($sort == 'desc') { echo 'active'; } ?>" href="?sort=desc">Desc</a> ]
							</div>
						</div>
						<div class="my-panel-body">
							<?php
								foreach($cats as $cat) {
									echo "<div class='cat'>";
										echo "<div class='hidden-buttons'>";
											echo "<a href='categories.php?adminPanel=Edit-cat&catid=" . $cat['ID'] . "' class='uk-button uk-button-primary uk-button-small'><span class='hashtag'></span> Edit</a>";
											echo "<a href='categories.php?adminPanel=Delete-cat&catid=" . $cat['ID'] . "' class='confirm uk-button uk-button-danger uk-button-small'><span class='close'></span> Delete</a>";
										echo "</div>";
										echo "<h3>" . $cat['Name'] . '</h3>';
										echo "<div class='full-view'>";
											echo "<p>"; if($cat['Description'] == '') { echo 'This category has no description'; } else { echo $cat['Description']; } echo "</p>";
											if($cat['Visibility'] == 1) { echo '<span class="visibility cat-span"><i class="fa fa-eye"></i> Hidden</span>'; }
											if($cat['Allow_Comment'] == 1) { echo '<span class="commenting cat-span"><i class="fa fa-close"></i> Comment Disabled</span>'; }
											if($cat['Allow_Ads'] == 1) { echo '<span class="advertises cat-span"><i class="fa fa-close"></i> Ads Disabled</span>'; }
										echo "</div>";

                    $childCat = get_all_rec("*", "categories", "parent= {$cat['ID']}");

                    if (!empty($childCat)) { ?>
                      <span class="advertises cat-span">Child Categories</span>
                      <?php
                      foreach ($childCat as $child) { ?>
                        <ul>
                          <li>
                            <a href="categories.php?adminPanel=Edit-cat&catid=<?php echo $child['ID']; ?>" class="uk-button uk-button-primary uk-button-small" >
                              <span class='hashtag'></span>
                               <?php echo $child["Name"]; ?>
                             </a>
                           </li>
                        </ul>

                        <?php
                      }

                    }

									echo "</div>";
									echo "<hr>";
								}
							?>
						</div>
            <div class="uk-card-footer uk-padding-remove">
              <a class="add-category uk-button uk-button-primary" href="categories.php?adminPanel=Add-cat"><span uk-icon="plus-circle"></span> Add New Category</a>

            </div>
					</div>
				</div>
<?php
			} else {

				echo '<div class="uk-container">';
					echo '<div class="nice-message">There\'s No Categories To Show</div>';
					echo '<a href="categories.php?adminPanel=Add-cat" class="btn btn-primary">
							<span uk-icon="plus"></span> New Category
						</a>';
				echo '</div>';

			} ?>
