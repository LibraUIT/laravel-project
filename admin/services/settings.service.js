'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Settings services of the application.
 */

laravelAdminApp.factory('SettingsServices', ['$http', function ($http) {

    var SettingsServices = {};

    SettingsServices.setGeneral = function (input) {
    	var params = [urlBaseApi, 'settings', 'set_general'].join('/')
        return $http({
	        method: 'POST',
	        url: params,
	        data: input
	      });
    };

    SettingsServices.getGeneral = function () {
        var params = [urlBaseApi, 'settings', 'get_general'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    return SettingsServices;

}]);