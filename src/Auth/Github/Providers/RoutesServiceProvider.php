<?php

namespace Auth\Github\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

/**
 * Class RoutesServiceProvider
 * @package Issues\Github\Providers
 */
class RoutesServiceProvider extends RouteServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = 'Auth\Github\Http\Controllers';

    public function map()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
    }
}