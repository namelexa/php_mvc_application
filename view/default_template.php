<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;

?>
<html>
<head>
    <title><?= $this->getTitle() ?></title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<div class="container">
    <header>
        <?php require_once 'view/header.php' ?>
    </header>
    <div class="main-layout">

        <div class="main-content-center">
            <?= $this->getHtml() ?>
        </div>

    </div>
    <footer>
        <?php require_once 'view/footer.php' ?>
    </footer>
</div>
</body>
</html>