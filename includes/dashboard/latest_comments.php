
<div class="uk-card-header uk-flex uk-flex-row-reverse uk-flex-middle">
  <div>
    <h3 class="uk-card-title uk-margin-remove MainColor">
      <i class="fas fa-comment-alt"></i>
      Latest Comments
    </h3>
  </div>
<buton class="uk-button uk-label toggle-info MainBack">
  <i class="fas fa-minus fa-1x"></i>
</buton>
</div>
          <div class="uk-card-body uk-padding-remove uk-margin-auto" uk-grid>
            <?php
            $stmt = $con->prepare("SELECT comments.*, users.Username
                                            FROM comments
                                            INNER JOIN users
                                            ON users.UserID = comments.`user-id` ORDER BY c_id DESC LIMIT 5;");
            $stmt->execute();
            $latestComments = $stmt->fetchAll();

              if(! empty($latestComments)) { ?>
                <div class="uk-width-1-1 uk-text-center" uk-grid>
                  <div class="uk-width-1-2">
                <h3 class="uk-card-title uk-margin-remove uk-label MainBack posts-tit">
                  <i class="fas fa-users"></i> Latest 5 Registerd Users
                </h3>
              </div>
              <!-- <div class="uk-width-1-2">
                <h3 class="uk-card-title uk-margin-remove uk-label MainBack posts-tit">
                  <i class="fas fa-users"></i> Latest 5 Added Posts
                </h3>
              </div> -->
              </div>
                <table class="uk-table uk-table-divider uk-table-striped latest_table uk-width-1-2 uk-margin-remove">
                  <thead>
                      <tr>
                          <th>Comment</th>
                          <th>Author</th>
                          <th>Controls</th>
                      </tr>
                  </thead>
                  <?php 	foreach ($latestComments as $comment) { ?>
                  <tbody>
                      <tr>
                          <td>
                            <span>
                            <?php echo $comment['comment']; ?>
                          </span>
                        </td>
                        <td>
                          <span>
                          <?php echo $comment['Username']; ?>
                        </span>
                      </td>
                          <td>
                            <a href="comments.php?adminPanel=Edit-comment&commid=<?php echo $comment['c_id']; ?>">Edit</a>
                          </td>
                          <td>
                            <?php if($comment['status'] == 0) { ?>
                              <a href="comments.php?adminPanel=Approve-comment&commid=<?php echo $comment['c_id']; ?>" class="activate">Approve</a>
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
              } ?>
        </div>
