<?php

namespace Auth\Github\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Session\SessionInterface;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Issues\Github\Factories\ClientFactory;

/**
 * Class AuthController
 * @package Issues\Github\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param Container $container
     * @param ClientFactory $factory
     * @return \Guzzle\Http\EntityBodyInterface|mixed|string
     */
    public function getUser(Container $container, ClientFactory $factory)
    {
        /** @var SessionInterface $session */
        $session = $container['session'];

        $client = $factory->setCredentials(
            $session->get('github_login'),
            $session->get('github_password')
        )->create();

        return [
            'data' => $client->currentUser()->show()
        ];
    }

    /**
     * @param Container $container
     * @param Request $request
     * @param ClientFactory $factory
     * @return \Guzzle\Http\EntityBodyInterface|mixed|string
     */
    public function login(Container $container, Request $request, ClientFactory $factory)
    {
        /** @var SessionManager|SessionInterface $session */
        $session = $container['session'];
        $session->set('github_login', $request->get('login'));
        $session->set('github_password', $request->get('password'));

        $client = $factory->setCredentials(
            $session->get('github_login'),
            $session->get('github_password')
        )->create();

        return $client->currentUser()->show();
    }

    /**
     * @param Container $container
     */
    public function logout(Container $container)
    {
        /** @var Store $session */
        $session = $container['session'];
        $session->forget('github_login');
        $session->forget('github_password');
    }
}