<ul class="<?= $class ?>">
    <?php foreach ($array as $menuItem) : ?>
    <li>
        <a href="<?php if (empty($_SESSION)) : ?>
                /?login=yes
                <?php else : ?>
                <?= $menuItem['path'] ?>
                <?php endif ?>"
        class="<?= active($menuItem) ?>"> <?= cutString($menuItem['title']) ?></a>
    </li>
    <?php endforeach ?>
</ul>