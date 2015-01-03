<?php

namespace Issues\Tests\Controller;

class CrudControllerTest extends \TestCase
{
    const VENDOR = 'symfony';
    const REPOSITORY = 'symfony';

    public function testListIssues()
    {
        $this->route('GET', 'issues::list', [
            'vendor'     => self::VENDOR,
            'repository' => self::REPOSITORY,
        ]);

        $this->assertResponseOk();
        $this->response->getContent();
//        $this->assertArraySubset()
    }
}