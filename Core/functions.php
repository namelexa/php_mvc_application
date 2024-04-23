<?php

declare(strict_types=1);
function show($stuff = null): void
{
    echo '<pre>';
    var_export($stuff);
    echo '</pre>';
}
