<?php
session_start();
if ( isset( $_POST['logout'] ) ) {
  $_SESSION = array();
}
header("location: /");
exit;


?>