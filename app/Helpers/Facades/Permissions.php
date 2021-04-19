<?php

namespace App\Helpers\Facades;

use App\Helpers\Services\PermissionsHelper;
use Illuminate\Support\Facades\Facade;

class Permissions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return PermissionsHelper::class;
    }
}
