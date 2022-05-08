<?php

namespace app\src;

class Request
{
    /**
     * @return bool
     */
    public function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getRequestPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
