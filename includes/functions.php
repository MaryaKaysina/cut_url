<?php
include "config.php";

function get_url($page = "") {
  return HOST . "/$page";
}

function db() {
  try {
    return new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=utf8", DB_USER, DB_PASS, [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function db_query($sql = '', $exec = false) {
  if (empty($sql)) return false;

  if ($exec) {
    return db()->exec($sql);
  }

  return db()->query($sql);
}

function get_user_count() {
  return db_query("SELECT count(`id`) FROM `users`;")->fetchColumn();
}

function get_views_count() {
  return db_query("SELECT sum(`views`) FROM `links`;")->fetchColumn();
}

function get_links_count() {
  return db_query("SELECT count(`id`) FROM `links`;")->fetchColumn();
}

function get_link_info($url) {
  if (empty($url)) return [];
  return db_query("SELECT * FROM `links` WHERE `short_link` = '$url';")->fetch();
}

function get_link_user($url) {
  if (empty($url)) return [];
  return db_query("SELECT `user_id` FROM `links` WHERE `id` = '$url';")->fetchColumn();
}

function get_user_info($login) {
  if (empty($login)) return [];
  return db_query("SELECT * FROM `users` WHERE `login` = '$login';")->fetch();
}

function update_views($url) {
  if (empty($url)) return false;
  return db_query("UPDATE `links` SET `views`= `views` + 1 WHERE `short_link` = '$url';", true);
}

function redirect($url = '') {
  if(isset($url) && !empty($url)) {
    $url = strtolower(trim($url));
    $link = get_link_info($url);
    if (empty($link)) {
      header('Location: 404.php');
      die();
    }
    update_views($url);
    header('Location: ' . $link['long_link']);
    die();
  }
}

function add_user($login, $pass) {
  $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
  return db_query("INSERT INTO `users` (`login`, `pass`) VALUES ('$login', '$pass_hash');" , true);
}

function register_user($auth_data) {
  if( empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || !isset($auth_data['pass-ok'])) return false;

  $user = get_user_info($auth_data['login']);

  if(!empty($user)) {
    $_SESSION['error'] = "Пользователь '" . $auth_data['login'] . "' уже существует!";
    header('Location: register.php');
    die();
  }

  if(empty($auth_data['pass'])) {
    $_SESSION['error'] = "Упс, пароль содержит слишком мало символов!";
    header('Location: register.php');
    die();
  }

  if($auth_data['pass'] !== $auth_data['pass-ok']) {
    $_SESSION['error'] = "Упс, введенные пароли не совпадают!";
    header('Location: register.php');
    die();
  }

  if(add_user($auth_data['login'], $auth_data['pass'])) {
    $_SESSION['success'] = "Вы в системе!";
    header('Location: login.php');
    die();
  }
  return true;
}

function login_user($auth_data) {
  if( empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || empty($auth_data['pass']) ) {
    $_SESSION['error'] = "Упс, логин или пароль не может быть пустым!";
    header('Location: login.php');
    die();
  }

  $user = get_user_info($auth_data['login']);

  if(empty($user)) {
    $_SESSION['error'] = "Логин или пароль неверен!";
    header('Location: login.php');
    die();
  }

  if(password_verify($auth_data['pass'], $user['pass'])) {
    $_SESSION['user'] = $user['id'];
    header('Location: profile.php');
    die();
  } else {
    $_SESSION['error'] = "Логин или пароль неверен!";
    header('Location: login.php');
    die();
  }
}

function logout() {
  session_destroy();
  header('Location: ' . HOST);
}

function get_user_links($user_id) {
  if (empty($user_id)) return [];
  return db_query("SELECT * FROM `links` WHERE `user_id` = $user_id;")->fetchAll();
}

function delete_link($id) {
  if (empty($id)) return false;
  return db_query("DELETE FROM `links` WHERE `id` = $id;", true);
}

function generate_str($size = 6) {
  $new_str = str_shuffle(URL_CHARS);
  return substr($new_str, 0, $size);
}

function add_link($user_id, $long_link) {
  $short_link = generate_str();
  return db_query("INSERT INTO `links` (`user_id`, `long_link`, `short_link`) VALUES ('$user_id', '$long_link', '$short_link');", true);
}

function edit_link($id, $link) {
  if (empty($id) || empty($link)) return false;
  return db_query("UPDATE `links` SET `long_link` = '$link' WHERE `id` = '$id';", true);
}

