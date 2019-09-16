<?php
// store scripts name into array with variable
$scripts = array('vue.min', 'uikit-icons.min', 'uikit.min','bootstrap.min', 'jquery-1.12.1.min', 'jquery-ui.min', 'main');

foreach ($scripts as $val) {
  on_scripts($val);
}
 ?>
</body>
</html>
