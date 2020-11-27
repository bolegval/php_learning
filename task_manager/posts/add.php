<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/messages.php');
?>
<a href="/" class="link">На главную</a>
<a href="/posts" class="link">Все сообщения</a>

<?php if (status(getUserByLogin()) !== '3') : ?>
<h3>Вы сможете отправлять сообщения после прохождения
модерации</h3>
<?php else : ?>
    <form action="#" method="post" class="form-add">
    <label for="title">Заголовок сообщения</label>
    <input id="title" type="text" name="title" placeholder="Введите заголовок">
    <label for="text">Текст сообщения</label>
    <textarea placeholder="Ваше ваше сообщение" id="text" type="text" name="messageText" cols="30" rows="8"></textarea>
    <label for="send_to">Кому отправить сообщение</label>
    <?= showOption(getOptionSelect('name', 'users'), "send_to") ?>
    <label for="message_section">Выберите раздел сообщения</label>
    <?= showOption(getOptionSelect('name', 'sections'), "message_section") ?>
    <label for="color_section">Выберите цвет раздела сообщения</label>
    <?= showOption(getOptionSelect('name', 'colors'), "color_section") ?>
    <input type="submit" name="sendMessage" class="send-message">
</form>
<?php endif ?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
?>