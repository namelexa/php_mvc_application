<?php

declare(strict_types=1);

namespace Test\Check24\Core;

use Test\Check24\Controller\AbstractController;
use Test\Check24\Core\Database\Connection;
use Test\Check24\Model\Post;

class Router
{
    private const string CONTROLLER_NAMESPACE = 'Test\\Check24\\Controller\\';

    /**
     * @throws \Exception
     */
    public function executeController(): void
    {
        try {
            $path = $this->getUrl();
            $path = str_replace('/', '\\', ucwords($path, '/'));
            $controllerPath = self::CONTROLLER_NAMESPACE . $path;

            if (!class_exists($controllerPath)) {
                $controllerPath = self::CONTROLLER_NAMESPACE . 'NotFound';
            }

            $resolver = new ReflectionResolver();

            /** @var $controller AbstractController */
            $controller = $resolver->resolve($controllerPath);
            $controller->execute();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function getUrl(): string
    {
        $url = $_SERVER['REQUEST_URI'] ? ltrim($_SERVER['REQUEST_URI'], '/') : '';

        return $url ?: 'HomePage';
    }
}
