// NOTE: I usually do not use $http in controllers
module.exports = [
    '$scope',
    '$state',
    '$http',
    'issues',
    function ($scope, $state, $http, issues) {
        $scope.issues = issues;
        $scope.params = $state.params;
        $scope.page = 1;
        console.log(issues);

        $scope.loadMore = function () {
            console.log('clicked');
            var page = ++$scope.page;
            var url = '/issues/github/' + $state.params.vendor + '/' + $state.params.repository + '?page=' + page;
            $http.get(url)
                .success(function (res) {
                    $scope.issues = $scope.issues.concat(res.issues);
                });
        };
    }
];