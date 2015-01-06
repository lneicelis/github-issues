<?php

namespace Issues\Github\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

    /**
     * @param Request $request
     * @param $vendor
     * @param $repository
     * @return array
     */
    public function createIssue(Request $request, $vendor, $repository)
    {
        $data = $request->only(['title', 'body']);

        try {
            $issue = $this->issuesRepo->createIssue($vendor, $repository, $data);
        } catch (\RuntimeException $e) {
            throw new NotFoundHttpException(
                sprintf('Repository %s/%s or issue was not found!', $vendor, $repository),
                $e
            );
        }

        return [
            'issue' => $issue
        ];
    }

    /**
     * @param Request $request
     * @param $vendor
     * @param $repository
     * @return array
     */
    public function updateIssue(Request $request, $vendor, $repository, $id)
    {
        $data = $request->only(['title', 'body']);

        try {
            $issue = $this->issuesRepo->updateIssue($vendor, $repository, $id, $data);
        } catch (\RuntimeException $e) {
            throw new NotFoundHttpException(
                sprintf('Repository %s/%s or issue was not found!', $vendor, $repository),
                $e
            );
        }

        return [
            'issue' => $issue
        ];
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @return array
     */
    public function closeIssue($vendor, $repository, $id)
    {
        try {
            $issue = $this->issuesRepo->updateIssue($vendor, $repository, $id, ['state' => 'closed']);
        } catch (\RuntimeException $e) {
            throw new NotFoundHttpException(
                sprintf('Repository %s/%s or issue was not found!', $vendor, $repository),
                $e
            );
        }

        return [
            'issue' => $issue
        ];
    }
}