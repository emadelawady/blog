			<div class="uk-container-small uk-margin-auto">
				<form action="?adminPanel=Insert-cat" method="POST">
					<!-- Start Name Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block">
								<label class="uk-label">Category Name</label>
								<input type="text" name="name" class="uk-input" autocomplete="off" required="required" placeholder="Category Name" />
							</div>
						</div>
					<!-- End Name Field -->
					<!-- Start Description Field -->
					<div class="uk-margin-small uk-width-1-1">
						<div class="uk-block">
							<label class="uk-label">Description</label>
							<input type="text" name="description" class="uk-input" placeholder="Category Description" />
						</div>
					</div>
					<!-- End Description Field -->
					<!-- Start Ordering Field -->
					<div class="uk-margin-small uk-width-1-1">
						<div class="uk-block">
							<label class="uk-label">Ordering</label>
							<input type="text" name="ordering" class="uk-input" placeholder="Number To Arrange The Categories" />
						</div>
					</div>
					<!-- End Ordering Field -->
					<!-- Start Category Type -->
					<div class="uk-margin-small uk-width-1-1">
						<div class="uk-block">
							<div class="uk-form-select" data-uk-form-select>
								<span>Parent ?</span>
								<select name="parent">
									<option value="">....</option>
								<?php
								$patents = get_all_rec('*', 'categories', 'parent = 0');
								foreach ($patents as $parent) {
									echo '
										<option value="'. $parent['ID'] .'">'. $parent['Name'] .'</option>
									';
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
								<input id="vis-yes" type="radio" name="visibility" value="0" checked />
								<label for="vis-yes">Yes</label>
							</div>
							<div>
								<input id="vis-no" type="radio" name="visibility" value="1" />
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
								<input id="com-yes" type="radio" name="commenting" value="0" checked />
								<label for="com-yes">Yes</label>
							</div>
							<div>
								<input id="com-no" type="radio" name="commenting" value="1" />
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
								<input id="ads-yes" type="radio" name="ads" value="0" checked />
								<label for="ads-yes">Yes</label>
							</div>
							<div>
								<input id="ads-no" type="radio" name="ads" value="1" />
								<label for="ads-no">No</label>
							</div>
						</div>
					</div>
					<!-- End Ads Field -->
					<!-- Start Submit Field -->
					<div class="uk-margin-small uk-width-1-1">
						<div class="uk-block">
							<input type="submit" value="Add Category" class="uk-button uk-button-primary" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>
