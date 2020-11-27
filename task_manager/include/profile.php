<?php
/**
 * Функция получения информации о пользователе с БД
 * @return array массив с данными о пользователе
 */
function getUserProfile() {
    $login = $_COOKIE['login'];

    $result = mysqli_query(
        getConnection(),
        "SELECT  u.*, g.name AS name_group, g.description, g.id AS status FROM task_manager.users AS u
        LEFT JOIN task_manager.group_user AS gu ON u.id = gu.user_id
        LEFT JOIN task_manager.groups AS g ON gu.group_id = g.id
        WHERE u.login = '$login'"
    );
    
    $profile = mysqli_fetch_assoc($result);
    
    return $profile;
}

$userProfile = getUserProfile();
