'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Dashboard controller of the application.
 */
laravelAdminApp.controller("DashboardController", function($scope, $location) {
	$('.uiview').removeClass('uiviewlogin')
  	$scope.template = {
        name: 'home.html',
        url: 'views/pages/home.html'};
    var params = $location.path().split('/')
    codeawesome.activeMenu(params[1])
});