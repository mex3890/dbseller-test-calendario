<?php

namespace Application\Helpers;

class Url
{
    /**
     * @return string|null
     */
    public static function getAdditionalPath()
    {
        if (empty($_GET['path'])) {
            return null;
        }

        $path = $_GET['path'];
        $path = $path[0] === '/' ? substr($path, 1) : $path;
        $path = $path[strlen($path) - 1] === '/' ? substr($path, 0, -1) : $path;

        return substr($path, -4, 4) === '.php' ? substr($path, 0, -4) : $path;
    }
}