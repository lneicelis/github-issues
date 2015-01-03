<?php

namespace Issues\Github\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Issues\Github\Contracts\IssuesRepositoryContract as IssuesRepository;

/**
 * Class IssueCommentsController
 * @package Issues\Github\Http\Controllers
 */
class IssueCommentsController extends Controller
{
    /**
     * @var IssuesRepository
     */
    private $issuesRepo;

    /**
     * @param IssuesRepository $issuesRepo
     */
    function __construct(IssuesRepository $issuesRepo)
    {
        $this->issuesRepo = $issuesRepo;
    }

    /**
     * @param string $vendor
     * @param string $repository
     * @param int $id
     * @return array
     */
    public function listComments($vendor, $repository, $id)
    {
        $page = Input::get('page', 1);

        $comments = $this->issuesRepo->getIssueComments($vendor, $repository, $id, $page);

        return [
            'comments' => $comments
        ];
    }
}