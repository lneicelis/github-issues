<?php

namespace Issues\Github\Factories;

use Github\Client;

/**
 * Class ClientFactory
 * @package Issues\Github\Factories
 */
class ClientFactory
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @return Client
     */
    public function create()
    {
        $client = new Client;

        if (!is_null($this->login) && !is_null($this->password)) {
            $client->authenticate($this->login, $this->password);
        }

        return $client;
    }

    /**
     * @param string $login
     * @param string $password
     * @return $this
     */
    public function setCredentials($login, $password)
    {
        $this->login = $login;
        $this->password = $password;

        return $this;
    }
}