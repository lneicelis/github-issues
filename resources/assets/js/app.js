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
            '$stateProvider',
            'auth.routesProvider',
            'issues.routesProvider',
            function ($stateProvider, authRoutes, issuesRoutes) {
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