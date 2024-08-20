<?php

function dd(...$parameters)
{
    dump($parameters);
    die();
}