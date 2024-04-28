<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;

$session = $this->getSession();
?>

<div class="add-post">
    <form action="/post/save" method="POST">
        <div style="padding: 20px 0"><input required type="text" placeholder="Title" name="title"/></div>
        <div><textarea required name="content" cols="30" rows="10" placeholder="Add your content here"></textarea></div>
        <button type="submit">Save post</button>
    </form>

    <?= $this->getUrlParams()['message'] ?? '' ?>

    <script>
        window.onload = function () {
            history.replaceState({}, document.title, window.location.pathname);
        };
    </script>
</div>
