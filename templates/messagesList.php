<ul class="messages-list">
    <?php if (empty($array)) : ?>
    <p>Нет сообщений</p>
    <?php else : ?>
    <?php foreach ($array as $listItem) : ?>
    <li>
        <a href="/posts/message.php?id=<?= $listItem['id'] ?>" class="messages-link" style="background-color: <?= $listItem['hex'] ?>">
            <p class="message-title">Тема сообщения: <?= $listItem['title'] ?></p>
            <p class="message-section">Раздел сообщения: <?= $listItem['name'] ?></p>
        </a>
    </li>
    <?php endforeach ?>
    <?php endif ?>
</ul>
