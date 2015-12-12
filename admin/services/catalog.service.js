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

laravelAdminApp.factory('CatalogServices', ['$http', function ($http) {

    var CatalogServices = {};

    CatalogServices.addCategory = function (input) {
    	var params = [urlBaseApi, 'catalog', 'add_category'].join('/')
        return $http({
	        method: 'POST',
	        url: params,
	        data: input
	      });
    };

    CatalogServices.getParentCategory = function () {
        var params = [urlBaseApi, 'catalog', 'get_parent_category'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    CatalogServices.getAllCategory = function () {
        var params = [urlBaseApi, 'catalog', 'get_all_category'].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    CatalogServices.deleteCategoryById = function (input) {
        var params = [urlBaseApi, 'catalog', 'delete_category_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    CatalogServices.getCategoryById = function (input) {
        var params = [urlBaseApi, 'catalog', 'get_category_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    CatalogServices.editCategory = function (input) {
        var params = [urlBaseApi, 'catalog', 'edit_category'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    CatalogServices.addProduct = function (input) {
        var params = [urlBaseApi, 'catalog', 'add_product'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };

    CatalogServices.getAllProductCatalog = function (input) {
        var params = [urlBaseApi, 'catalog', 'get_all_product_catalog', input ].join('/')
        return $http({
            method: 'GET',
            url: params,
            data: {}
          });
    };

    CatalogServices.deleteProductById = function (input) {
        var params = [urlBaseApi, 'catalog', 'delete_product_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    };
    CatalogServices.getProductById = function (input)
    {
        var params = [urlBaseApi, 'catalog', 'get_product_by_id'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    }

    CatalogServices.editProduct = function(input)
    {
        var params = [urlBaseApi, 'catalog', 'edit_product'].join('/')
        return $http({
            method: 'POST',
            url: params,
            data: input
          });
    }


    return CatalogServices;

}]);