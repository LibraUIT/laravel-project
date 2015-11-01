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

    WidgetsServices.addGallery = function (input) {
        var params = [urlBaseApi, 'widgets', 'add_gallery'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    WidgetsServices.getAllGallery = function (input) {
        var params = [urlBaseApi, 'widgets', 'get_all_gallery', input ].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    WidgetsServices.deleteGallery =  function(input)
    {
        var params = [urlBaseApi, 'widgets', 'delete_gallery_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
        });
    };

    return WidgetsServices;

}]);