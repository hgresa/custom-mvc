<?php

namespace app\src;

class Controller
{
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * @param $templateName
     * @param array|null $args
     * @return int
     */
    public function renderView($templateName, array $args = null): int
    {
        return View::renderView($templateName, $args);
    }
}
