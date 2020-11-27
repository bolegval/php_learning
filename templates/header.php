<?php
require($_SERVER['DOCUMENT_ROOT'] . '/authorization/authorization.php');
require($_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles/styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>

<body>

    <div class="header">
    	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>
    <div class="clear">
        <?= showMenu($menu) ?>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <td   td class="left-collum-index">
            <h1><?= pageTitle($menu) ?></h1>
	    </td>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/rightSide.php'); ?>
    </table>
