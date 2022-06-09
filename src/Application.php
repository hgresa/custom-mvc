<?php

namespace app\src;

class Application
{
    private Router $router;

    public function __construct() {
        $request = new Request();
        $this->router = new Router($request);
    }

    /**
     * @return void
     */
    public function run(): void
    {
       $this->router->execute();
    }   
}
