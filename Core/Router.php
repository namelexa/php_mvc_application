<?php

declare(strict_types=1);

namespace Test\Check24\Core;

use Test\Check24\Controller\AbstractController;

class Router
{
    private const string CONTROLLER_NAMESPACE = 'Test\\Check24\\Controller\\';

    /**
     * @throws \Exception
     */
    public function executeController(): void
    {
        $this->startSession();
        // TODO generate CSRF token for session and add to all forms for security.

        try {
            $path = $this->getUrl();

            $path = str_replace('/', '\\', ucwords($path, '/'));
            $controllerNamespace = self::CONTROLLER_NAMESPACE . $path;

            if (!class_exists($controllerNamespace)) {
                $controllerNamespace = self::CONTROLLER_NAMESPACE . 'NotFound';
            }

            $resolver = new ReflectionResolver();

            /** @var $controller AbstractController */
            $controller = $resolver->resolve($controllerNamespace);
            $controller->setUrlParams($_GET);
            $controller->setSession($_SESSION);
            $controller->execute();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function getUrl(): string
    {
        $url = $_SERVER['REQUEST_URI'] ? ltrim($_SERVER['REQUEST_URI'], '/') : '';
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '';

        return str_replace('_', '', ucwords($path, '_')) ?: 'HomePage';
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
