module.exports = [function () {
    return {
        $get: function () {},
        addTo: function (stateProvider) {
            stateProvider
                .state('issues', {
                    url: '/issues/{vendor}/{repository}',
                    templateUrl: '/views/issues/issues.html',
                    data: {
                        pageTitle: 'Issues List'
                    },
                    controller: 'issues.issuesCtrl',
                    resolve: {
                        issues: ['$q', '$http', '$stateParams', function ($q, $http, $stateParams) {
                            var deferred = $q.defer();

                            $http.get('/issues/github/' + $stateParams.vendor + '/' + $stateParams.repository)
                                .success(function (res) {
                                    deferred.resolve(res.issues);
                                });

                            return deferred.promise;
                        }]
                    }
                })
                .state('issue', {
                    url: '/issue/{vendor}/{repository}/{id}',
                    templateUrl: '/views/issues/issue.html',
                    data: {
                        pageTitle: 'Issue'
                    },
                    controller: 'issues.issueCtrl',
                    resolve: {
                        issue: ['$q', '$http', '$stateParams', function ($q, $http, $stateParams) {
                            var deferred = $q.defer();
                            var params = $stateParams;

                            $http.get('/issues/github/' + params.vendor + '/' + params.repository + '/' + params.id)
                                .success(function (res) {
                                    deferred.resolve(res.issue);
                                });

                            return deferred.promise;
                        }],
                        comments: ['$q', '$http', '$stateParams', function ($q, $http, $stateParams) {
                            var deferred = $q.defer();
                            var params = $stateParams;

                            $http.get('/issues/github/' + params.vendor + '/' + params.repository + '/' + params.id + '/comments')
                                .success(function (res) {
                                    deferred.resolve(res.comments);
                                });

                            return deferred.promise;
                        }]
                    }
                })
            ;
        }
    }
}];