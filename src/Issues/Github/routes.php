<?php

/** @var \Illuminate\Routing\Router $router */

$router->group([
    'prefix'    => '/issues/github',
], function ($router) {
    /** @var \Illuminate\Routing\Router $router */

    $router->get('/repositories/{keyword}', [
        'uses' => 'RepositoriesController@search'
    ]);

    $router->get('/{vendor}/{repository}/{id}', [
        'as'   => 'issues::show',
        'uses' => 'CrudController@showIssue'
    ]);

    $router->get('/{vendor}/{repository}/{id}/comments', [
        'as'   => 'issues::show',
        'uses' => 'IssueCommentsController@listComments'
    ]);

    $router->get('/{vendor}/{repository}', [
        'as'   => 'issues::list',
        'uses' => 'CrudController@listIssues'
    ]);
});