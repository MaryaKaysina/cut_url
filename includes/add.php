<?php
include "functions.php";

if(isset($_POST['link']) && !empty($_POST['link'])) {
  if(add_link($_SESSION['user'], $_POST['link'])) {
    $_SESSION['success'] = 'Ссылка успешно добавлена!';
  } else {
    $_SESSION['error'] = 'Упс, что-то пошло не так!';
  }
}

header('Location: ' . HOST . '/profile.php');
die();
