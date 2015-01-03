<?php

namespace Issues\Github\Providers;

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
    protected $namespace = 'Issues\Github\Http\Controllers';

    public function map()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }
}