<?php

namespace Auth\Integration;

class AuthControllerTest extends \TestCase
{
    const LOGIN = '4testing';
    const PASSWORD = 'just4testing';

    public function testLogin()
    {
        $this->route('POST', 'auth::login', [
            'login'    => self::LOGIN,
            'password' => self::PASSWORD
        ]);

        $this->assertResponseOk();
        $this->assertJson($this->response->getContent());
    }
}