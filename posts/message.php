<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/messages.php');
?>

<a href="/" class="link">На главную</a>
<a href="/posts/add.php" class="link">Написать сообщение</a>
<a href="/posts" class="link">Назад к списку сообщений</a>

<?php if (status(getUserByLogin()) !== '3') : ?>
<h3>Вы сможете отправлять сообщения после прохождения
модерации</h3>
<?php else : ?>
<?= openMessage(getOpenMessage()) ?>
<?php endif ?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
?>