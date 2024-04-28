<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;

$session = $this->getSession();
?>
<div class="right">
    <a href="/">Logo</a>
</div>
<div class="left">

    <?php
    if ($this->isLoggedIn()) {
        require_once 'view/user/log_out.php'; ?>
        <a href='/post/add'>Add new post</a>
        <?php
    } else {
        require_once 'view/user/log_in_form.php';
    }
    ?>
</div>
