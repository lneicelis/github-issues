module.exports = [function () {
    return {
        $get: function () {},
        addTo: function (stateProvider) {
            stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: '/views/auth/login.html',
                    data: {
                        pageTitle: 'Login'
                    },
                    controller: 'auth.loginCtrl'
                })
            ;
        }
    }
}];