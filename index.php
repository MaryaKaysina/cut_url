<?php
  include "includes/header.php";
  redirect($_GET['url']);
?>
<main class="container">
  <?php if(!isset($_SESSION['user'])) { ?>
    <div class="row mt-5">
      <div class="col">
        <h2 class="text-center">Необходимо <a href="<?php echo get_url("register.php"); ?>">зарегистрироваться</a> или <a href="<?php echo get_url("login.php"); ?>">войти</a> под своей учетной записью</h2>
      </div>
    </div>
  <?php } ?>

  <div class="row mt-5">
    <div class="col">
      <h2 class="text-center">Пользователей в системе: <?php echo $users_count ?></h2>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col">
      <h2 class="text-center">Ссылок в системе: <?php echo $links_count ?></h2>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col">
      <h2 class="text-center">Всего переходов по ссылкам: <?php echo $views_count ?></h2>
    </div>
  </div>
</main>
<?php include "includes/footer.php"; ?>
