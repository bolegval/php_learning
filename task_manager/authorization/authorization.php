<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/include/connection.php');
session_name('session_id');
session_cache_expire(20);
session_start();

$isAuth = null;

if (! empty($_POST)) {

    if (isset($_COOKIE['login'])) {
        $login = $_COOKIE['login'];
    } else {
        $login = htmlspecialchars($_POST['login']);
    }

    $result = mysqli_fetch_assoc(mysqli_query(
        getConnection(), 
        "SELECT `id`, `login`, `password` FROM `users` WHERE `login` = '$login'"
    ));
 
    $isAuth = password_verify($_POST['password'], $result['password']);
    $id = $result['id'];

    if ($isAuth) {
        $_SESSION['isAuth'] = 'yes';
        setcookie('login', $login, time() + 30 * 24 * 3600, '/');
        mysqli_query(getConnection(), 
        "UPDATE `task_manager`.`users` SET `active` = '1' WHERE `id` = '$id'"
        );
    }
    mysqli_close(getConnection());
}

if (isset($_GET['login']) && $_GET['login'] == 'no') {
    $login = $_COOKIE['login'];
    $result = mysqli_fetch_assoc(mysqli_query(
    getConnection(), 
        "SELECT `id`, `login` FROM `users` WHERE `login` = '$login'"
    ));
    
    $id = $result['id'];

    mysqli_query(getConnection(), 
        "UPDATE `task_manager`.`users` SET `active` = '0' WHERE `id` = '$id'"
    );
        
    mysqli_close(getConnection());

    unset($_SESSION['isAuth']);
    setcookie('login', '', time() - 3600);
    header("Location: /");
}

if (isset($_COOKIE['login']) && !isset($_GET['login'])) {
    setcookie('login', $_COOKIE['login'], time() + 30 * 24 * 3600, '/');
}