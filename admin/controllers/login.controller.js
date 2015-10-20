'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Login controller of the application.
 */
laravelAdminApp.controller("LoginController", function($scope, $rootScope, $timeout) {
	$('.uiview').addClass('uiviewlogin')
  	$timeout(function() {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    }, 0);
});