<?php
/**
 * @var $this AbstractController
 */

use Test\Check24\Controller\AbstractController;
use Test\Check24\Model\Post;

?>
<div class="posts-list">
    <?php show($_SESSION);
    foreach ($this->getPosts() as $post) {
        /** @var $post Post */
        ?>
        <div class="post">
            <h3 class="title"><?= $post->getTitle() ?></h3>
            <p class="content"><?= $post->getContent()?></p>
            <div class="post-bottom">
                <a href="#" onclick="document.getElementById('edit').submit(); return false;">
                    Edit
                </a>
                <p class="updated-at"><?= $post->getUpdatedAt()?></p>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<form id="edit" method="post" action="/post/edit">
    <input type="hidden" name="logOut" value="true">
</form>