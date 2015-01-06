// NOTE: I usually do not use $http in controllers
module.exports = [
    '$scope',
    '$state',
    '$http',
    'issues.issueService',
    'issues',
    'user',
    function ($scope, $state, $http, issueService, issues, user) {
        $scope.user = user.user;
        $scope.issues = issues;
        $scope.params = $state.params;
        $scope.page = 1;
        $scope.form = {};
        $scope.showForm = false;

        $scope.toggleForm = function () {
            $scope.showForm = !$scope.showForm;
        };

        $scope.loadMore = function () {
            var page = ++$scope.page;
            var url = '/issues/github/' + $state.params.vendor + '/' + $state.params.repository + '?page=' + page;
            $http.get(url)
                .success(function (res) {
                    $scope.issues = $scope.issues.concat(res.issues);
                });
        };

        $scope.logout = function () {
            user.logout().success(function () {
                $state.go('login');
            });
        };
        
        $scope.submit = function () {
            issueService.createIssue(
                $state.params.vendor,
                $state.params.repository,
                $scope.form
            ).success(function (res) {
                    $state.go('issue', {
                        vendor: $scope.params.vendor,
                        repository: $scope.params.repository,
                        id: res.issue.number
                    });
                });
        }
    }
];