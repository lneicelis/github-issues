module.exports = [
    '$q',
    '$http',
    function ($q, $http, $state) {
        var self = this;

        this.user = {};
        this.resolveUser = function () {
            var deferred = $q.defer();
            $http.get('/auth/github/user')
                .success(function (res) {
                    self.user = res.data;
                    deferred.resolve(self);
                })
                .error(function () {
                    deferred.resolve({});
                });

            return deferred.promise;
        };

        this.login = function (data) {
            return $http({
                method: 'POST',
                url: '/auth/github/login',
                data: $.param(data),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        this.logout = function () {
            return $http.post('/auth/github/logout');
        };
    }
];