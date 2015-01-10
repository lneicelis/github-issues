module.exports = [function () {
    return {
        $get: function () {},
        addTo: function (stateProvider) {
            stateProvider
                .state('issues', {
                    url: '/issues/{vendor}/{repository}?state',
                    templateUrl: '/views/issues/issues.html',
                    data: {
                        pageTitle: 'Issues List'
                    },
                    controller: 'issues.issuesCtrl',
                    resolve: {
                        issues: ['$q', '$http', '$stateParams', function ($q, $http, $stateParams) {
                            var deferred = $q.defer();
                            var params = $stateParams.state ? {state: $stateParams.state} : {};

                            $http.get(
                                '/issues/github/' + $stateParams.vendor + '/' + $stateParams.repository,
                                {params: params}
                            ).success(function (res) {
                                    deferred.resolve(res.issues);
                                });

                            return deferred.promise;
                        }],
                        user: ['auth.userService', function (UserService) {
                            return UserService.resolveUser();
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
                        issue: ['$stateParams', 'issues.issueService', function ($stateParams, IssueService) {

                            return IssueService.resolveIssue(
                                $stateParams.vendor,
                                $stateParams.repository,
                                $stateParams.id
                            );
                        }],
                        comments: ['$q', '$http', '$stateParams', function ($q, $http, $stateParams) {
                            var deferred = $q.defer();
                            var params = $stateParams;

                            $http.get('/issues/github/' + params.vendor + '/' + params.repository + '/' + params.id + '/comments')
                                .success(function (res) {
                                    deferred.resolve(res.comments);
                                });

                            return deferred.promise;
                        }],
                        user: ['auth.userService', function (UserService) {
                            return UserService.resolveUser();
                        }]
                    }
                })
                .state('issueCreate', {
                    url: '/issue/{vendor}/{repository}/{id}/form',
                    templateUrl: '/views/issues/issue-form.html',
                    data: {
                        pageTitle: 'Issue'
                    },
                    controller: 'issues.issueCreateCtrl'
                })
            ;
        }
    }
}];