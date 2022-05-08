<?php

namespace app\src;

class Router
{
    protected static array $routes;

    private Request $request;

    /**
     * @param Request $request
     */
    public function __construct(
       Request $request
    ) {
       $this->request = $request;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getCallback($path)
    {
        $requestMethod = $this->request->getRequestMethod();
        if (!isset(self::$routes[$requestMethod][$path])) {
           throw new \Error('requested path does not exist');
        }

        return self::$routes[$requestMethod][$path];
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $path = $this->request->getRequestPath();
        $callback = $this->getCallback($path);

        $obj = new $callback[0]();
        $method = $callback[1];

        return call_user_func([$obj, $method]);
    }
}
