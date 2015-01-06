module.exports = ['$q', '$http',
    function ($q, $http) {
        var self = this;
        self.deferred = $q.defer();
        self.issue = {};

        self.resolveIssue = function (vendor, repository, id) {
            var url = '/issues/github/' + vendor + '/' + repository + '/' + id;

            $http.get(url).success(function (res) {
                self.issue = res.issue;

                self.deferred.resolve(self);
            });

            return self.deferred.promise;
        };

        self.createIssue = function (vendor, repository, data) {

            return $http.post('/issues/github/' + vendor + '/' + repository, data);
        };

        self.updateIssue = function (vendor, repository, id, data) {

            return $http({
                method: 'PATCH',
                url: '/issues/github/' + vendor + '/' + repository + '/' + id,
                data: data
            });
        };

        self.closeIssue = function (vendor, repository, id) {

            return $http.post('/issues/github/' + vendor + '/' + repository + '/' + id + '/close');
        };
    }
];