/* global angular */
/* global require */

(function () {
    angular.module('app.auth', [])
        .provider('auth.routes', require('./routes'))
        .controller('auth.loginCtrl', require('./controllers/LoginCtrl'))
        .service('auth.userService', require('./services/UserService'))
    ;
})();