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

    WidgetsServices.editGallery = function (input) {
        var params = [urlBaseApi, 'widgets', 'edit_gallery'].join('/')
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


    WidgetsServices.addHotelFacilties = function (input) {
        var params = [urlBaseApi, 'widgets', 'add_hotel_facilties'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    WidgetsServices.getAllHotelFacilties = function (input) {
        var params = [urlBaseApi, 'widgets', 'get_all_hotel_facilties', input ].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    WidgetsServices.deleteHotelFacilties =  function(input)
    {
        var params = [urlBaseApi, 'widgets', 'delete_hotel_facilties_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
        });
    };

    WidgetsServices.editHotelFacilties = function (input, id) {
        var params = [urlBaseApi, 'widgets', 'edit_hotel_facilties'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: {input : input, id : id }
          });
    };

    WidgetsServices.addBackgroundHotelFacilties = function (input) {
        var params = [urlBaseApi, 'widgets', 'add_background_hotel_facilties'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    WidgetsServices.getBackgroundHotelFacilties = function () {
        var params = [urlBaseApi, 'widgets', 'get_background_hotel_facilties' ].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    WidgetsServices.removeBackgroundHotelFacilties = function () {
        var params = [urlBaseApi, 'widgets', 'remove_background_hotel_facilties'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: {}
          });
    };

    return WidgetsServices;

}]);