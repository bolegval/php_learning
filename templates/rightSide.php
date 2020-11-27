<td class="right-collum-index">	
	<div class="project-folders-menu">
		<ul class="project-folders-v"> 
        <?php if (empty($_SESSION)) : ?>
			<li class="project-folders-v-active">
			<a href="/?login=yes">Авторизация</a>
			</li>
			<li><a href="#">Регистрация</a></li>
			<li><a href="#">Забыли пароль?</a></li>
            <?php else : ?>
			<li><a href="/?profile">Мой профиль</a></li>
			<li><a href="/posts">Сообщения</a></li>
			<li><a href="/?login=no">Выйти</a></li>
			<?php endif ?>
		</ul>
	    <div class="clearfix"></div>
	</div>
	<div class="index-auth">
    <?php if (isset($_GET['login']) && !$isAuth) : ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/authForm.php') ?>
    <?php endif ?>

	<?php if ($isAuth) : ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/success.php') ?>
    <?php endif ?>

	<?php if (isset($_GET['profile'])) : ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/profile.php') ?>
	<?php endif ?>

	<?php if (isset($_GET['posts'])) : ?>
	<?php include($_SERVER['DOCUMENT_ROOT'] . '/posts/index.php') ?>
	<?php endif ?>
	</div>
</td>