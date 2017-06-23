<?php
require ("header.php");

if(!isset($view)){
  echo $messageErreur;
}
else {
  $filepath = VIEW_PATH . $controller . DS;
  $filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
  require ("{$filepath}{$filename}");
}

require ("footer.php");
?>
