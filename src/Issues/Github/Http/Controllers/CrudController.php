<?php

namespace Issues\Github\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\View\Factory;
use Issues\Github\Contracts\IssuesRepositoryContract as IssuesRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CrudController
 * @package App\Http\Controllers\Issues\GitHub
 */
class CrudController extends Controller
{
    /**
     * @var IssuesRepository
     */
    protected $issuesRepo;

    /**
     * @param IssuesRepository $issuesRepository
     */
    public function __construct(IssuesRepository $issuesRepository)
    {
        $this->issuesRepo = $issuesRepository;
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @return \Illuminate\View\View
     */
    public function listIssues($vendor, $repository)
    {
        $params = [
            'page' => Input::get('page', 1)
        ];

        try {
            $issues = $this->issuesRepo->getIssuesOf($vendor, $repository, $params);
        } catch (\RuntimeException $e) {
            throw new NotFoundHttpException(
                sprintf('Repository %s/%s was not found!', $vendor, $repository),
                $e
            );
        }

        return [
            'vendor'     => $vendor,
            'repository' => $repository,
            'issues'     => $issues,
        ];
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showIssue($vendor, $repository, $id)
    {
        try {
            $issue = $this->issuesRepo->find($vendor, $repository, $id);
        } catch (\RuntimeException $e) {
            throw new NotFoundHttpException(
                sprintf('Repository %s/%s or issue was not found!', $vendor, $repository),
                $e
            );
        }

        return [
            'vendor'     => $vendor,
            'repository' => $repository,
            'issue'      => $issue,
        ];
    }
}