<?php

namespace app\controllers;

use app\src\Controller;

class BaseController extends Controller
{
    /**
     * @return int
     */
    public function index(): int
    {
        return $this->renderView('index');
    }
}
