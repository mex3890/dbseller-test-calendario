<?php

namespace Application\Helpers;

class Str
{
    public static function hasSpecialCharacter($string)
    {
        return preg_match('/[^a-zA-Z0-9]/', $string) > 0;
    }
}