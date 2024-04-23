<?php

declare(strict_types=1);

namespace Test\Check24\Controller;

class NotFound extends AbstractController
{

    public function execute(): void
    {
        $this->renderView($_SERVER['REQUEST_URI']);
    }
}