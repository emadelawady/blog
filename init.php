<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
// the initial file for whole app
include 'admin/connect.php';



if (isset($_SESSION['user'])) {
  $session_user = $_SESSION['user'];
} else{
  $session_user = '';
}
// define paths
$includes = 'includes/';
$functions = 'includes/functions/';
$templates = 'includes/templates/';
$components = 'includes/components/';

$css = 'layout/css/';
$js = 'layout/js/';


// include parts
include $functions . 'functions.php';
//include $templates . 'header.php';
$actual_link = "http://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$getArr = explode('/', $actual_link);

$current_page = '';
if (isset($current_page)) {
  $current_page = end($getArr);
}

$user_state = $con->prepare("SELECT * FROM users WHERE Username = ?");
$user_state->execute(array($session_user));


  $user_info = $user_state->fetch();


  /**
   * class for holding headers and footers
   */
  class hook {

    public $components = 'includes/components/';


    public function inc_header($part = Null, $dash = Null, $header = 'header'){
      $temps = 'includes/templates/';
    return $head = include $temps . $header. $dash . $part. '.php';
    }
    public function inc_footer($part = Null, $dash = Null,$footer = 'footer'){
      $temps = 'includes/templates/';
    return $foot = include $temps . $footer. $dash . $part. '.php';
    }

    public function component($name, $php = NULL) {
        if ($php != NULL) {
          $php = '.php';
        }
        $url = $this->components . $name . $php;

      return $url;
    }
  }
  $hook_up = new hook();

 ?>
