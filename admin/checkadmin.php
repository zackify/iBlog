<?php
Session_start();
if(!isset($_SESSION['user'])){
header("Location: ../login");
die();
}
?>