<?php

declare(strict_types=1);

namespace Test\Check24\Controller;

abstract class AbstractController
{
    protected const  string GET = 'GET';
    protected const string POST = 'POST';
    protected const string PUT = 'PUT';
    protected const string PATCH = 'PATCH';
    protected const string DELETE = 'DELETE';

    protected string $title = 'Default Title';
    protected ?string $template = null;
    protected array $data = [];
    protected string $html = '';

    abstract public function execute();

    protected function renderView($name): void
    {
        $newFilename = preg_replace('/(?<=\w)([A-Z])/', '_$1', $name);
        $newFilename = strtolower($newFilename);
        $filename = 'view' . $newFilename . '.php';

        if (!file_exists($filename)) {
            $filename = 'view/not_found.php';
        }
        $this->template = $filename;

        ob_start();
        require_once $filename;
        $this->setHtml(ob_get_clean());

        require_once('view/default_template.php');
    }

    protected function checkRequest($requestType): bool
    {
        return $requestType === $_SERVER['REQUEST_METHOD'];
    }

    protected function setData(array $data): void
    {
        $this->data = $data;
    }

    protected function getData(): array
    {
        return $this->data;
    }

    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    protected function getTitle(): string
    {
        return $this->title;
    }

    protected function setHtml(string|bool $content): void
    {
        $this->html = $content;
    }

    protected function getHtml(): string
    {
        return $this->html ?? htmlspecialchars_decode($this->html);
    }


    protected function edit($view, $data = [])
    {
    }

    protected function delete($view, $data = [])
    {
    }
}
