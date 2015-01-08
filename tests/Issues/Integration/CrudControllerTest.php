<?php

namespace Issues\Integration;

use AspectMock\Test;
use Github\Api\Issue;
use Issues\Github\Repositories\IssuesApiRepository;

class CrudControllerTest extends \TestCase
{
    const LOGIN = '4testing';
    const PASSWORD = 'just4testing';
    const VENDOR = 'luknei';
    const REPOSITORY = 'github-issues';
    const NUMBER = 1;

    public function testListIssues()
    {
        $repoMock = Test::double(IssuesApiRepository::class, [
            'getIssuesOf' => [],
        ]);

        $this->route('GET', 'issues::list', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
        ]);

        $repoMock->verifyInvokedOnce('getIssuesOf');
        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }

    public function testFindIssue()
    {
        $repoMock = Test::double(IssuesApiRepository::class, [
            'find' => [],
        ]);

        $this->route('GET', 'issues::show', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
            'id'         => self::NUMBER
        ]);

        $repoMock->verifyInvokedOnce('find');
        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }

    public function testOpenIssue()
    {
        $repoMock = Test::double(IssuesApiRepository::class, [
            'createIssue' => [],
        ]);

        $this->route('POST', 'issues::create', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY
        ], [
            'title' => 'test',
            'body'  => 'test body'
        ]);

        $repoMock->verifyInvokedOnce('createIssue');
        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }

    public function testCloseIssue()
    {
        $repoMock = Test::double(IssuesApiRepository::class, [
            'updateIssue' => [],
        ]);

        $this->route('POST', 'issues::close', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
            'id'         => 123
        ]);

        $repoMock->verifyInvokedOnce('updateIssue');
        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }

    public function testUpdateIssue()
    {
        $repoMock = Test::double(IssuesApiRepository::class, [
            'updateIssue' => [],
        ]);

        $this->route('PATCH', 'issues::update', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
            'id'         => 123
        ], [
            'title' => 'test title',
            'budy'  => 'test body'
        ]);

        $repoMock->verifyInvokedOnce('updateIssue');
        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }
}