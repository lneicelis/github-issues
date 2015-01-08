<?php

namespace Issues\Github\Repositories;

use Illuminate\Contracts\Container\Container;
use Illuminate\Session\SessionInterface;
use Issues\Github\Contracts\IssuesRepositoryContract;
use Issues\GitHub\Factories\ClientFactory as GitHubClient;

/**
 * Class IssuesApiRepository
 * @package Issues\Github\Repositories
 */
class IssuesApiRepository implements IssuesRepositoryContract
{
    /**
     * @var GitHubClient
     */
    private $gitHubClient;

    /**
     * @param GitHubClient $factory
     * @param Container $container
     * @internal param GitHubClient $gitHubClient
     */
    public function __construct(GitHubClient $factory, Container $container)
    {
        /** @var SessionInterface $session */
        $session = $container['session'];

        $this->gitHubClient = $factory->setCredentials(
            $session->get('github_login'),
            $session->get('github_password')
        )->create();
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param  array $params
     * @return array
     */
    public function getIssuesOf($vendor, $repository, $params = [])
    {
        return $this->gitHubClient->issues()->all($vendor, $repository, $params);
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @return array
     */
    public function find($vendor, $repository, $id)
    {
        return $this->gitHubClient->issues()->show($vendor, $repository, $id);
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @param int $page
     * @return array
     */
    public function getIssueComments($vendor, $repository, $id, $page = 1)
    {
        return $this->gitHubClient->issues()->comments()->all($vendor, $repository, $id, $page);
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @param array $data
     * @return array
     */
    public function updateIssue($vendor, $repository, $id, array $data)
    {
        return $this->gitHubClient->issues()->update($vendor, $repository, $id, $data);
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param array $data
     * @return array
     * @throws \Github\Exception\MissingArgumentException
     */
    public function createIssue($vendor, $repository, array $data)
    {
        return $this->gitHubClient->issues()->create($vendor, $repository, $data);
    }
}