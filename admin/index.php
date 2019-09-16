<?php
ob_start(); // output baffering start

session_start();

if(isset($_SESSION['Username'])) {
  //redirect to dashboard if session set
  header('Location: dashboard.php?adminPanel=Manage-dash');
}
$noNav = '';
include 'init.php';

// Check If User Coming From HTTP POST Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $hashed = sha1($pass);

  $state = $con->prepare("SELECT UserID, Username, Password
                          FROM
                            users
                          WHERE
                            Username = ?
                          AND
                            Password = ?
                          AND
                            GroupID = 1
                          LIMIT 1");
  $state->execute(array($user, $hashed));
  $row = $state->fetch();
  $count = $state->rowCount();

  if($count > 0){
    $_SESSION['Username'] = $user;
    $_SESSION['ID'] =  $row['UserID'];
    header('Location: dashboard.php?adminPanel=Manage-dash');

    exit();
  }
}
 ?>
<div class="uk-container uk-text-center">
  <h2 class="">Admin Login</h2>
<form class="uk-form uk-margin-small uk-background-primary uk-height-1-1 uk-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="uk-form-row uk-text-center">
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">User Name</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="user" class="uk-padding-small" type="text" id="user" placeholder="Admin User Name"  autocomplete="off">
    </div>
  </div>
  <div class="uk-margin">
  <label class="uk-form-label uk-padding-small" for="password">Password</label>
  <div class="uk-form-controls uk-inline-clip">
    <input name="pass" class="uk-padding-small" type="password" id="password" placeholder="Admin Password" autocomplete="new-password">
      </div>
    </div>
    <div class="uk-margin">
    <div class="uk-form-controls">
      <input class="uk-button uk-button-primary" type="submit" id="submit" value="log in">
        </div>
      </div>
  </div>
</form>
</div>
 <?php include $templates . 'footer.php'; ?>
 <?php ob_end_flush(); // Release The Output ?>
