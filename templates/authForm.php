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
			<li><a href="/?login=no">Выйти</a></li>
			<?php endif ?>
		</ul>
	    <div class="clearfix"></div>
	</div>
	<div class="index-auth">
    <?php if (! empty($_GET) && !$isAuth) : ?>
        <?php if (!$isAuth && $isAuth !== null) : ?>
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/error.php') ?>
        <?php endif ?>
        <form action="/?login=yes" method="post">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="iat">
                        <?php if (!isset($_COOKIE['login'])) : ?>
                        <label for="login_id">Ваш e-mail:</label>
                        <input id="login_id" size="30" name="login" value="<?= $login ?? '' ?>">
                        <?php endif ?>
                    </td>
				</tr>
				<tr>
					<td class="iat">
                        <label for="password_id">Ваш пароль:</label>
                        <input id="password_id" size="30" name="password" type="password" value="<?= $password ?? '' ?>">
                    </td>
				</tr>
				<tr>
					<td><input type="submit" value="Войти"></td>
				</tr>
			</table>
        </form>
        <?php endif ?>
        <?php if ($isAuth) : ?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/success.php') ?>
        <?php endif ?>
	</div>
</td>