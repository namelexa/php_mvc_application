<?php

declare(strict_types=1);

namespace Test\Check24\Controller\Post;

use ErrorException;
use PDOException;
use Test\Check24\Controller\AbstractController;
use Test\Check24\Repository\Post as PostRepository;

class Save extends AbstractController
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {
    }

    public function execute()
    {
        $message = 'Post not saved';

        if (!$this->checkRequest(self::POST) || !$this->isLoggedIn()) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . '?message' . $message);
            //TODO add handling for wrong request method
            exit;
        }

        $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_SPECIAL_CHARS);
        $authorId = $this->getSession()['user_id'];

        try {
            $this->postRepository->add($authorId, $title, $content);
            $message = 'Post saved';
        } catch (PDOException $e) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . '?message' . $message);
            exit;
        } catch (\ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }

        header("Location: " . $_SERVER['HTTP_REFERER'] . '?message=' . $message);
        exit;
        //TODO handling messages. Add set/ get message to the abstract controller
    }
}