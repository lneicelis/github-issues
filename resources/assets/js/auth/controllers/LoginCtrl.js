module.exports = [
    '$scope', 'auth.userService',
    function ($scope, userService) {
        $scope.form = {};
        $scope.login = function () {
            userService.login($scope.form)
        };
    }
];