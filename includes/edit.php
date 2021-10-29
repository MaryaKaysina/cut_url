<?php
include_once "functions.php";
include_once "header.php";

if(!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: ' . HOST . '/profile.php');
  die();
}
?>

<div class="row mx-auto mt-5" >
  <form class="row justify-content-md-center" action="#" method="POST">
    <input class="form-control me-5 w-50" type="text" placeholder="Ссылка" aria-label="Ссылка" name="edit_link">
    <button class="btn btn-success h-100 w-25" type="submit">Изменить ссылку</button>
  </form>
</div>

<?php
if(isset($_POST['edit_link']) && !empty($_POST['edit_link'])) {
  edit_link($_GET['id'], $_POST['edit_link']);
  $_SESSION['success'] = "Ссылка изменена!";
  header('Location: ' . HOST . '/profile.php');
}
