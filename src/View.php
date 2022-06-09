<?php

namespace app\src;

use app\Config;

class View
{
    /**
     * @param $templateName
     * @param array|null $args
     * @return int
     */
    public static function renderView($templateName, array $args = null)
    {
        if ($args) {
            foreach ($args as $key => $value) {
                $$key = $value;
            }
        }

        if (substr($templateName, -4) == '.php')
        {
           $templateName = substr($templateName, 0, -4);
        }

        ob_start();
        include_once Config::VIEW_PATH . "$templateName.php";
        return print ob_get_clean();
    }
}
