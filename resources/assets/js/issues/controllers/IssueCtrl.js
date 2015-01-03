module.exports = [
    '$scope',
    '$state',
    'issue',
    'comments',
    function ($scope, $state, issue, comments) {
        $scope.issue = issue;
        $scope.comments = comments;
        $scope.params = $state.params;
        console.log(issue, comments);
    }
];