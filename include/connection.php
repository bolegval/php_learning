<?php

function getConnection() {
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $dbname = 'task_manager';
    static $db;

    if (empty($db)) {
        $db = mysqli_connect($host, $user, $password, $dbname) or die('Ошибка соединения');
    }

    return $db;
}
