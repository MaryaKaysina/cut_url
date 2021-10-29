<?php
include "functions.php";

if(!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: ' . HOST . '/profile.php');
  die();
}

if($_SESSION['user'] !== get_link_user($_GET['id'])) {
  header('Location: ' . HOST . '/profile.php');
  die();
}

delete_link($_GET['id']);
$_SESSION['success'] = "Ссылка уничтожена безвозвратно!";
header('Location: ' . HOST . '/profile.php');
die();
