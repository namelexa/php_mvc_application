<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;

$session = $this->getSession();
$email = $session['email'] ?? '';
?>
<div class="logout">
    <p>User: <?= $email ?> logged In</p>
    <a href="#" onclick="document.getElementById('postForm').submit(); return false;">
        Click me to send POST request
    </a>

    <form id="postForm" method="post" action="user/log_out">
        <input type="hidden" name="logOut" value="true">
    </form>
</div>
