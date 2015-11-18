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

    ContentServices.getParentCategory = function () {
        var params = [urlBaseApi, 'content', 'get_parent_category'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    ContentServices.getAllCategory = function () {
        var params = [urlBaseApi, 'content', 'get_all_category'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    ContentServices.deleteCategoryById = function (input) {
        var params = [urlBaseApi, 'content', 'delete_category_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    ContentServices.getCategoryById = function (input) {
        var params = [urlBaseApi, 'content', 'get_category_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    ContentServices.editCategory = function (input) {
        var params = [urlBaseApi, 'content', 'edit_category'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    ContentServices.addPost = function (input) {
        var params = [urlBaseApi, 'content', 'add_post'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };


    return ContentServices;

}]);