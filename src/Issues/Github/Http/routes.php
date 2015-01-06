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

    $router->post('/{vendor}/{repository}',[
        'as'   => 'issues::create',
        'uses' => 'CrudController@createIssue'
    ]);

    $router->post('/{vendor}/{repository}/{id}/close',[
        'as'   => 'issues::close',
        'uses' => 'CrudController@closeIssue'
    ]);

    $router->patch('/{vendor}/{repository}/{id}',[
        'as'   => 'issues::update',
        'uses' => 'CrudController@updateIssue'
    ]);

    $router->get('/{vendor}/{repository}', [
        'as'   => 'issues::list',
        'uses' => 'CrudController@listIssues'
    ]);
});