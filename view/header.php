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
    if (!empty($session) && isset($session['logged_in']) && $session['logged_in'] === true) {
        require_once 'view/user/log_out.php';
    } else {
        require_once 'view/user/log_in_form.php';
    }
    ?>
</div>
