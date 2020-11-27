<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/messages.php');
?>

<a href="/" class="link">На главную</a>
<a href="/posts/add.php" class="link">Написать сообщение</a>

<?php if (status(getUserByLogin()) !== '3') : ?>
<h3>Вы сможете отправлять сообщения после прохождения
модерации</h3>
<?php else : ?>
    <div class="messages">
<div class="read">
<h4>Прочитанные сообщения</h4>
    <?= showMessage(getAllMessage()) ?>
</div>
<div class="unread">
<h4>Непрочитанные сообщения</h4>
    <?= showMessage(getAllMessage(0)) ?>
</div>
</div>
<?php endif ?>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
?>
