<?php

namespace Lotarbo\MetaTags\Facades;

use Illuminate\Support\Facades\Facade;

class MetaTags extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Lotarbo\MetaTags\MetaTags::class;
    }
}
