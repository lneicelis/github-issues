<?php

namespace Issues\Github\Contracts;

/**
 * Class IssuesApiRepository
 * @package Issues\Github\Repositories
 */
interface IssuesRepositoryContract
{
    /**
     * @param string $keyword
     * @return array
     */
    public function search($keyword);

    /**
     * @param string $vendor
     * @param string $repository
     * @param array $params
     * @return array
     */
    public function getIssuesOf($vendor, $repository, $params = []);

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @return array
     */
    public function find($vendor, $repository, $id);

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @param int $page
     * @return array
     */
    public function getIssueComments($vendor, $repository, $id, $page = 1);
}