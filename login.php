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
<div class="container">
<div class="row">
    <div class="col-sm-12">
      <form class="login row" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="col-sm-12 form-group">
          <h1 class="text-center">مرحبا مجددا</h1>
        </div>
        <div class="col-sm-12 col-lg-6 form-group">
          <input name="user" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" id="user" placeholder="اسم المستخدم"  autocomplete="off">
        </div>
        <div class="col-sm-12 col-lg-6 form-group">
          <input name="pass" class="form-control" type="password" id="password" placeholder="كلمة المرور" autocomplete="new-password">
        </div>
        <div class="col-sm-12 form-group text-center">

        <button id="submit" name="login" type="submit" class="btn" style="background: #673ab7;color:#fff;">تسجيل دخول</button>
      </div>
        <div class="form-group">
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
          <div class="">
            <?php echo $success; ?>
         </div>
        <?php
        }
           ?>
        </div>
      </form>
    </div>
</div>
</div>

<?php include $templates . 'footer-main.php'; ?>
