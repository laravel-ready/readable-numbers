<?php

namespace LaravelReady\ReadableNumbers\Facades;

use Illuminate\Support\Facades\Facade;

class ReadableNumbers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'readable-numbers';
    }
}
