module.exports = [
    '$scope', '$state', 'auth.userService',
    function ($scope, $state, userService) {
        $scope.form = {};
        $scope.message = null;
        $scope.login = function () {
            userService.login($scope.form)
                .success(function () {
                    $state.go('issues', {
                        vendor: 'luknei',
                        repository: 'github-issues'
                    })
                })
                .error(function () {
                    $scope.message = 'Login or password is incorrect.'
                });
        };
    }
];