<?php
//проверка статуса пользователя
/**
 * Функция получения данных о группах пользователя из БД
 * @return array массив с именем и id группы пользователя
 */
function getUserByLogin() {
    $login = $_COOKIE['login'];
    
    $result = mysqli_query(
        getConnection(),
        "SELECT  u.name, g.id FROM `users` AS u
        LEFT JOIN `group_user` AS gu ON u.id = gu.user_id
        LEFT JOIN `groups` AS g ON gu.group_id = g.id
        WHERE u.login = '$login'"
    );

    $profile = mysqli_fetch_assoc($result);
    
    return $profile;
}

/**
 * Функция проверки статуса пользователя
 * @return string индекс статуса пользователя
*/
function status($array) {
    return $array['id'];
}

//получение всех сообщений
/**
 * Функция получения всех сообщений из БД
 * @param int $messageStatus статус сообщения (0 - не прочитанноеб 1 - прочитанное)
 * @return array Список сообщений в соотвествии со статусом
 */
function getAllMessage($messageStatus = 1) {
    $getMessage = mysqli_query(
    getConnection(),
        "SELECT m.*, s.name, s.subsection, colors.name AS color, colors.hex FROM messages AS m
        LEFT JOIN sections AS s ON m.section_id = s.id
        LEFT JOIN colors ON s.color_id = colors.id"
    );

    $messages = mysqli_fetch_all($getMessage, MYSQLI_ASSOC);
    $messageList = [];

    foreach ($messages as $message) {
        if ($message['read'] == $messageStatus){
            $messageList[] = $message;
        } 
    }

    if (empty($messageList)) {
        return;
    }

    return $messageList;
}

/**
 * Функция вывода сообщений
 * @param array $array исходный массив для вывода
 * @return void список сообщений в соотвествии с данными в массиве
*/
function showMessage($array) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/messagesList.php');
}

//Просмотр сообщения
/**
 * Функция получения данных о сообщении
 * @return array массив с данными для вывода сообщения
 */
function getOpenMessage() {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string(getConnection(), $_GET['id']);
    }
    
    $getInfoMessage = mysqli_query(
    getConnection(),
    "SELECT m.title, m.date, m.sender, m.text, u.name, u.email FROM messages AS m
    LEFT JOIN users AS u ON m.sender = u.id
    WHERE m.id = $id;"
    );

    $openMessage = mysqli_fetch_assoc($getInfoMessage);

    return $openMessage;
}

/**
 * Функция вывода просматриваемого сообщения
 * @param array $array исходный массив для вывода
 * @return void вывод сообщения в соотвествии с данными в массиве
*/
function openMessage($array) {
    $id = mysqli_real_escape_string(getConnection(), $_GET['id']);

    mysqli_query(
        getConnection(),
        "UPDATE `messages` SET `read` = '1' WHERE `id` = '$id';"
    );
    mysqli_close(getConnection());
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/openMessage.php');
}

//Добавление сообщения
/**
 * Функция данных выбора параметров сообщений
 * @param string $column колонка по котрой происходит сортировка
 * @param string $table сортируемая таблица
 * @return array массив параметров для выбора в форме
*/
function getOptionSelect($column, $table) {
    $column = mysqli_real_escape_string(getConnection(), $column);
    $table = mysqli_real_escape_string(getConnection(), $table);
    

    $result = mysqli_query(
        getConnection(),
        "SELECT $column FROM $table GROUP BY $column"
    );

    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $options;
}

/**
 * Функция формирования option в select
 * @param array $array массив параметров 
 * @param string $name class и id select
 * @return void список option
 */
function showOption($array, $name) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/formSelect.php');
}

/**
 * Функция получения id пользователя из БД
 * @param string $column колонка по которой ищем id
 * @param string $name имя пользователя
 * @return string id пользователя
 */
function getIdUser($table, $column, $name) {
    $table = mysqli_real_escape_string(getConnection(), $table);
    $column = mysqli_real_escape_string(getConnection(), $column);
    $name = mysqli_real_escape_string(getConnection(), $name);

    $result = mysqli_query(
        getConnection(),
        "SELECT * FROM $table WHERE $column = '$name'"
    );

    $user = mysqli_fetch_assoc($result);

    return $user['id'];
}

/**
 * Функция записи сообщения в БД
 * @return void запись в базу данных
 */
function addMessage() {
    $title = $_POST['title'];
    $text = $_POST['messageText'];
    $login = $_COOKIE['login'];
    $nameSender = $_POST['send_to'];
    $nameSection = $_POST['message_section'];
    $sender = getIdUser('users','login', $login);
    $recepient = getIdUser('users','name', $nameSender);
    $section = getIdUser('sections','name', $nameSection);

    if ($sender != $recepient) {
        mysqli_query(
            getConnection(),
            "INSERT INTO `messages` (`title`, `text`, `sender`, `recepient`, `section_id`)
            VALUES ('$title', '$text', '$sender', '$recepient', '$section')"
        );
    } else {
        echo '<p style="color:red">Сообщение не отправлено! Не правильно указан получатель.</p>' ;
    }
}

if (isset($_POST['sendMessage'])) {
    addMessage();
}
