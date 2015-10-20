'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * File manager services of the application.
 */

laravelAdminApp.factory('FileManagerServices', ['$http', function ($http) {

    var FileManagerServices = {};

    FileManagerServices.uploadSingleFile = function (input) {
        var params = [urlBaseApi, 'file_manager', 'upload_single_file'].join('/')
        return $http({
            method: 'POST',
            url: params,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined},
            data: input
          });
    };

    FileManagerServices.getAll = function (input) {
        var params = [urlBaseApi, 'file_manager', 'get_all'].join('/')
        return $http({
            method: 'POST',
            url: params,
            headers: {'Content-Type': undefined},
            data: input
          });
    };

    return FileManagerServices;

}]);