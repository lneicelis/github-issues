/* global angular */
/* global require */

(function () {
    angular.module('app.issues', [])
        .provider('issues.routes', require('./routes'))
        .controller('issues.issuesCtrl', require('./controllers/IssuesCtrl'))
        .controller('issues.issueCtrl', require('./controllers/IssueCtrl'))
    ;
})();