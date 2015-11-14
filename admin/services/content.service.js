'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Content services of the application.
 */

laravelAdminApp.factory('ContentServices', ['$http', function ($http) {

    var ContentServices = {};

    ContentServices.addCategory = function (input) {
    	var params = [urlBaseApi, 'content', 'add_category'].join('/')
        return $http({
	        method: 'POST',
	        url: params,
	        data: input
	      });
    };

    ContentServices.getGeneral = function () {
        var params = [urlBaseApi, 'settings', 'get_general'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    return ContentServices;

}]);