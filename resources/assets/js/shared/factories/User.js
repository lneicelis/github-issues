module.exports = ['$q', '$http', function ($q, $http) {
    var User = {
        deferred: $q.defer(),
        user: {},
        resolveUser: function () {
            $http.get('/user/current')
                .success(function (res) {
                    User.user = res.data;
                    User.deferred.resolve(User);
                });

            return User.deferred.promise;
        },
        isLoggedIn: !!this.user
    };

    return User;
}];