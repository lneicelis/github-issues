<?php

namespace Issues\Github\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;
use Issues\Github\Contracts\IssuesRepositoryContract;
use Issues\Github\Repositories\IssuesApiRepository;

/**
 * Class IssuesServiceProvider
 * @package Issues\Github\Providers
 */
class IssuesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IssuesRepositoryContract::class, IssuesApiRepository::class);
    }

    public function boot()
    {
        /** @var Factory $view */
        $view = $this->app['view'];

        $view->addNamespace('issues', __DIR__ . '/../resources/templates');
    }
}