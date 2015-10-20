'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Layout Options services of the application.
 */

laravelAdminApp.factory('LayoutOptionsServices', ['$http', function ($http) {

    var LayoutOptionsServices = {};

    LayoutOptionsServices.getHomePageLayoutOption = function () {
    	var params = [urlBaseApi, 'layout_options', 'get_home_page'].join('/')
        return $http.get(params);
    };

    LayoutOptionsServices.setHomePageLayoutOption = function (input) {
    	var params = [urlBaseApi, 'layout_options', 'set_home_page'].join('/')
        return $http({
	        method: 'POST',
	        url: params,
	        data: {data : input} 
	      });
    };

    return LayoutOptionsServices;

}]);