<?php

define('SITE_NAME', 'Cut your URL');
define('SITE_NAME_404', 'Cut your URL - 404 Not found');
define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/cut_url');
define('DB_HOST', '127.0.0.1'); //localhost
define('DB_NAME', 'db_cut_url');
define('DB_USER', 'root');
define('DB_PASS', '');

define('URL_CHARS', 'qwertyuiopasdfghjklzxcvbnm0123456789-');

session_start();

