'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Widgets services of the application.
 */

laravelAdminApp.factory('WidgetsServices', ['$http', function ($http) {

    var WidgetsServices = {};

    WidgetsServices.setMainSlider = function (input) {
    	var params = [urlBaseApi, 'widgets', 'set_main_slider'].join('/')
        return $http({
	        method: 'POST',
	        url: params,
	        data: input
	      });
    };

    WidgetsServices.getMainSlider = function () {
        var params = [urlBaseApi, 'widgets', 'get_main_slider'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    return WidgetsServices;

}]);