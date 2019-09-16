<?php
session_start();
$pageTitle = 'Login';
include 'init.php';
$hook_up->inc_header();


if (isset($_session['user'])) {
  // redirect to Home page
  header('Location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['login'])) {
  // get Values from the FORM by POST method
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $hasedPass = sha1($pass);

  $stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ?");


  $stmt->execute(array($user, $hasedPass));

  $get = $stmt->fetch();

  $count = $stmt->rowCount();

  if ($count > 0) {

    $_SESSION['user'] = $user;
    $_SESSION['u_id'] = $get['UserID'];

    header('Location: profile.php');
    exit();
    }
  } else{
    $formErrors = array();

    $username 	= $_POST['user'];
    $password 	= $_POST['pass'];
    $password2 	= $_POST['pass2'];
    $email 		= $_POST['email'];

    if (isset($username)) {

      $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

      if (strlen($filterdUser) < 4) {

        $formErrors[] = 'Username Must Be Larger Than 4 Characters';

      }

    } // end username
    if (isset($password) && isset($password2)) {
      if (empty($password)) {
        $formErrors[] = 'Must write password';
      }
      $pass_n = sha1($password);
      $pass2_n = sha1($password2);
      if ($pass_n !== $pass2_n) {
        $formErrors[] = 'Password Must Match';

      }

    } // end Password Match
    if (isset($email)) {
      $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
      if (filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
        $formErrors[] = 'Email Must Be Valid';
      }
    } // end Email
    // Check If There's No Error Proceed The Update Operation

    if (empty($formErrors)) {

      // Check If User Exist in Database

      $check = checkItem("Username", "users", $username);

      if ($check == 1) { ?>

        <div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
          <?php $formErrors[] = '<span class="uk-alert-danger">Sorry This User Is Exist</span>'; ?>
      </div>
    <?php	} else {

        // Insert Userinfo In Database

        $stmt = $con->prepare("INSERT INTO
                      users(Username, Password, Email, RegStatus, Date)
                    VALUES(:zuser, :zpass, :zmail, 0, now()) ");
        $stmt->execute(array(
          'zuser' 	=> $username,
          'zpass' 	=> sha1($password),
          'zmail' 	=> $email
        ));
         $success = "<div class='uk-alert-success'>Your Account has been created, you can act like a member now</div>";
      }

    }
  }
}

$actual_link = "http://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>

<div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
    <div class="uk-width-1-1">
            <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                        <h3 class="uk-card-title uk-text-center">مرحبا مجددا</h3>
                        <form class="uk-form uk-height-1-1 uk-width-1-1 uk-flex uk-flex-middle uk-text-center login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" uk-grid>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <input name="user" class="uk-input uk-form-large" type="text"  id="user" placeholder="اسم المستخدم"  autocomplete="off">
                                </div>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <input name="pass" class="uk-input uk-form-large" type="password" id="password" placeholder="كلمة المرور" autocomplete="new-password">
                            </div>
                            <div class="uk-width-1-1">
                                <input class="uk-button uk-button-primary" name="login" type="submit" id="submit" value="تسجيل دخول">
                            </div>
                            <div class="uk-width-1-1 uk-text-small uk-text-center">
                                لست مسجلا بعد ؟ <a href="register.php">انضم الينا</a>
                            </div>
                        </form>
                        <div class="uk-width-1-1 errors">
                          <?php
                          global $formErrors;
                        //  print_r($formErrors);

                        if (is_array($formErrors) || is_object($formErrors))
                        {
                            foreach ($formErrors as $err)
                            {
                              echo $err . '<br>';
                            }
                        }
                        if (isset($success)) { ?>
                          <div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
                            <?php echo $success; ?>
                         </div>
                        <?php
                        }
                           ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>


<?php include $templates . 'footer-main.php'; ?>
