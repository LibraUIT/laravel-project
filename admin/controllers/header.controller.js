'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Header common controller of the application.
 */
laravelAdminApp.controller("HeaderController", function($scope, $rootScope, $timeout, $auth, $state, $http) {
	$scope.btnSignOut =  function()
    {
        $auth.logout();
        $state.go('login', {});
    }
});