<?php

namespace KhantNyar\Laraflow;

use Illuminate\Support\Facades\Facade;

/**
 * @see \KhantNyar\Laraflow\Skeleton\SkeletonClass
 */
class LaraflowFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraflow';
    }
}
