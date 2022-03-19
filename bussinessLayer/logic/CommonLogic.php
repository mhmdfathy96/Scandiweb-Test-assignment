<?php

namespace app\bussinessLayer\logic;

class CommonLogic
{
    public static function fromNonToStatic($callback): array
    {
        $handler=new $callback[0];
        return [$handler,$callback[1]];
    }
}