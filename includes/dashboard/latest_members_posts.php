
          <div class="uk-card-body uk-padding-remove uk-margin-auto" uk-grid>
            <?php
              if(! empty($latestUsers)) { ?>
                <div class="uk-width-1-1 uk-text-center" uk-grid>
                  <div class="uk-width-1-2">
                <h3 class="uk-card-title uk-margin-remove uk-label MainBack posts-tit">
                  <i class="fas fa-users"></i> Latest <?php echo $numUsers ?> Registerd Users
                </h3>
              </div>
              <div class="uk-width-1-2">
                <h3 class="uk-card-title uk-margin-remove uk-label MainBack posts-tit">
                  <i class="fas fa-users"></i> Latest <?php echo $numPosts ?> Added Posts
                </h3>
              </div>
              </div>
                <table class="uk-table uk-table-divider uk-table-striped latest_table uk-width-1-2 uk-margin-remove">
                  <thead>
                      <tr>
                          <th>User Name</th>
                          <th>Edit Profile</th>
                          <th>Activate User</th>
                      </tr>
                  </thead>
                  <?php 	foreach ($latestUsers as $user) { ?>
                  <tbody>
                      <tr>
                          <td>
                            <span>
                            <?php echo $user['Username']; ?>
                          </span>
                        </td>
                          <td>
                            <a href="members.php?do=Edit&userid=<?php echo $user['UserID']; ?>">Edit</a>
                          </td>
                          <td>
                            <?php if($user['RegStatus'] == 0) { ?>
                              <a href="members.php?do=Activate&userid=<?php echo $user['UserID']; ?>" class="activate">Activat</a>
                            <?php	} else {
                              echo "<i class='fas fa-check'></i>";
                            } ?>
                          </td>
                      </tr>
                  </tbody>
                <?php
              } ?>
            </table>
              <?php
              } else {
                echo 'There\'s No Members To Show';
              }

              if(! empty($latestPosts)) { ?>
                <table class="uk-table uk-table-divider uk-table-striped latest_table border_left_ccc uk-width-1-2 uk-margin-remove">
                  <thead>
                      <tr>
                          <th>Post Title</th>
                          <th>Content</th>
                          <th>Approve Post</th>
                      </tr>
                  </thead>
                  <?php 	foreach ($latestPosts as $post) { ?>
                  <tbody>
                      <tr>
                          <td>
                            <span>
                            <?php echo $post['Name']; ?>
                          </span>
                        </td>
                          <td>
                            <a href="posts.php?adminPanel=Edit-posts&postid=<?php echo $user['Post_ID']; ?>">Edit</a>
                          </td>
                          <td>
                            <?php if($post['Approve'] == 0) { ?>
                              <a href="posts.php?adminPanel=Approve-posts&postid=<?php echo $post['Post_ID']; ?>" class="activate">Approve</a>
                            <?php	} else {
                              echo "<i class='fas fa-check'></i>";
                            } ?>
                          </td>
                      </tr>
                  </tbody>
                <?php
              } ?>
            </table>
              <?php
              } else {
                echo 'There\'s No Members To Show';
              }
            ?>
        </div>
