<?php
require($_SERVER['DOCUMENT_ROOT'] . '/include/profile.php');
?>

<ul class="profile">
    <li>Логин: <?= $userProfile['login'] ?></li>
    <li>ФИО пользователя: <?= $userProfile['name'] ?></li>
    <li>Телефон: <?= $userProfile['phone'] ?></li>
    <li>Email: <?= $userProfile['email'] ?></li>
    <li>Группа пользователя: <?= $userProfile['name_group'] ?></li>
    <li>Описание группы: <?= $userProfile['description'] ?></li>
</ul>