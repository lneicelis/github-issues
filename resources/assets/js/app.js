(function () {
    require('jquery');
    require('angular');
    require('angular-ui-router');
    require('angular-moment');
    require('./shared');
    require('./issues');
    require('./auth');

    angular.module('app', [
        'ui.router',
        'angularMoment',
        'app.shared',
        'app.issues',
        'app.auth'
    ])
        .config([
            '$urlRouterProvider',
            '$stateProvider',
            'auth.routesProvider',
            'issues.routesProvider',
            function ($urlRouterProvider,$stateProvider, authRoutes, issuesRoutes) {
                $urlRouterProvider.otherwise('/login');

                authRoutes.addTo($stateProvider);
                issuesRoutes.addTo($stateProvider);
            }
        ])
        .run([
            '$rootScope',
            '$state',
            function ($rootScope, $state) {
                $rootScope.$state = $state;
            }
        ])
    ;
})();