module.exports = [
    '$scope',
    'User',
    function ($scope, User) {
        $scope.user = null;
        User.resolveUser().then(function (User) {
            $scope.user = User.user;
        })
    }
];