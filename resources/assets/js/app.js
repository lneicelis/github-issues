(function () {
    require('jquery');
    require('angular');
    require('angular-ui-router');
    require('angular-moment');
    require('./shared');
    require('./issues');

    angular.module('app', [
        'ui.router',
        'angularMoment',
        'app.shared',
        'app.issues'
    ])
        .config([
            '$stateProvider',
            'issues.routesProvider',
            function ($stateProvider, issuesRoutes) {
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