module.exports = [
    '$scope',
    '$state',
    'issue',
    'comments',
    'user',
    'issues.issueService',
    function ($scope, $state, issue, comments, user, IssueService) {
        $scope.issue = issue.issue;
        $scope.comments = comments;
        $scope.user = user.user;
        $scope.params = $state.params;
        $scope.showForm = false;
        $scope.form = {
            title: $scope.issue.title,
            body: $scope.issue.body
        };

        $scope.toggleForm = function () {
            $scope.showForm = !$scope.showForm;
        };

        $scope.submit = function () {
            IssueService.updateIssue(
                $state.params.vendor,
                $state.params.repository,
                $state.params.id,
                $scope.form
            ).success(function (res) {
                    $scope.issue = res.issue;
                    $scope.showForm = false;
                });
        };

        $scope.closeIssue = function () {
            IssueService.closeIssue(
                $state.params.vendor,
                $state.params.repository,
                $state.params.id
            ).success(function (res) {
                    $scope.issue = res.issue;
                });
        };
    }
];