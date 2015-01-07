<?php

namespace Issues\Tests\Integration;

class CrudControllerTest extends \TestCase
{
    const VENDOR = 'luknei';
    const REPOSITORY = 'github-issues';
    const NUMBER = 1;

    public function testListIssues()
    {
        $this->route('GET', 'issues::list', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
        ]);

        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }

    public function testFindIssue()
    {
        $this->route('GET', 'issues::show', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
            'id'         => self::NUMBER
        ]);

        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }
}