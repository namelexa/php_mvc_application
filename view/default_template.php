<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;

?>
<html>
<head>
    <title><?= $this->getTitle() ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <?php require_once 'view/header.php' ?>
</header>
<div class="main-section">
    <div class="main-content-left">
        <ul>
            <li><a href="?">main page</a></li>
            <li><a href="?page=article&amp;action=add">add article</a></li>
    </div>
    <div class="main-content-center">
        <?= $this->getHtml() ?>
    </div>
    <div class="main-content-right">
        right menu
    </div>
</div>
<footer>
    <?php require_once 'view/footer.php' ?>
</footer>
</body>
</html>