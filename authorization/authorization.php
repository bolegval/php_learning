<?php 
session_name('session_id');
session_cache_expire(20);
session_start();

$isAuth = null;

if (! empty($_POST)) {
    require($_SERVER['DOCUMENT_ROOT'] . '/data/logins.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/data/passwords.php');
   

    if (isset($_COOKIE['login'])) {
        $login = $_COOKIE['login'];
    } else {
        $login = htmlspecialchars($_POST['login']);
    }
     
    $password = htmlspecialchars($_POST['password']);
    $index = array_search($login, $logins);
    $isAuth = $index !== false && $password == $passwords[$index];
}

if ($isAuth) {
    $_SESSION['isAuth'] = 'yes';
    setcookie('login', $login, time() + 30 * 24 * 3600, '/');
}

if (isset($_GET['login']) && $_GET['login'] == 'no') {
    unset($_SESSION['isAuth']);
    setcookie('login', '', time() - 3600);
    header("Location: /");
}

if (isset($_COOKIE['login']) && !isset(($_GET['login']))) {
    setcookie('login', $_COOKIE['login'], time() + 30 * 24 * 3600, '/');
}