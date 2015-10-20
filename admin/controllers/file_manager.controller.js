'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Widgets controllers of the application.
 */

/**
* File Manager controller
*/
laravelAdminApp.controller("FileManagerController", function($scope, $rootScope, $timeout, $routeParams, $route, $location, $window, FileManagerServices) {
	$scope.template = {
                name: 'file_manager.html',
                url: 'views/pages/file_manager/file_manager.html'};      
    $scope.breacum_active = 'File Manager' 
    $scope.heading_title = 'Image manager'
    $scope.refresh = 0
    $scope.success = 0
    var file, oldLoaded = 0, oldTime = 0, filesize = 0
    var folder = 'uploads/images'
    $scope.addFile = function(input) {
        var files = document.getElementById($(input).attr('id')).files; 
        file = files[0]
        var rule = ['image/jpeg', 'image/png']
        if( rule.indexOf(file.type) )
        {
            alert('No support file type !')
        }else
        {
            var reader = new FileReader();
            reader.onload = function (e) {
               filesize = (e.total/1000) + ' KB'
               $('#file_name').text(file.name)
               $('#file_size').text(filesize)
               $('#image-holder').find('img').attr('src', e.target.result)
               $('.start').removeAttr('disabled')
            }
            reader.readAsDataURL(file);
        }
    }
    $scope.submit = function()
    {
        $scope.refresh = 1
        var data = new FormData();
        data.append('filename', file.name);
        data.append('file', file);
        FileManagerServices.uploadSingleFile(data).success(function(res){
            $scope.refresh = 0
            if(res.status == 'OK')
            {
                $('.start').attr('disabled', '')
                $('#file_name').text('')
                $('#file_size').text('')
                $('#image-holder').find('img').attr('src', '')
                $scope.success = 1
                $timeout(function() {
                       $scope.success = 0
                       $window.location.reload();
                    }, 2000);

            }else
            {
                $scope.error = 1
                $('.start').attr('disabled', '')
            }
        });
    }
    $scope.images = [];
    $('.show_image').hide();
    FileManagerServices.getAll(folder).success(function(res){      
        $scope.images = res
        if(res.length > 0)
        {
            $('.show_image').show();
        }
    });

    $scope.getImage = function(img)
    {
        localStorage.selectImage = $(img).attr('src')
    }      
});

laravelAdminApp.controller("ImageManagerController", function($scope, $rootScope, $timeout, $routeParams, $route, $location, $window, FileManagerServices) {
    $scope.template = {
                name: 'file_manager.html',
                url: 'views/pages/file_manager/file_manager.html'};      
    $scope.breacum_active = 'File Manager' 
    $scope.heading_title = 'Image manager'
    $scope.refresh = 0
    $scope.success = 0
    var file, oldLoaded = 0, oldTime = 0, filesize = 0
    var folder = 'uploads/images'
    $scope.addFile = function(input) {
        var files = document.getElementById($(input).attr('id')).files; 
        file = files[0]
        var rule = ['image/jpeg', 'image/png']
        if( rule.indexOf(file.type) )
        {
            alert('No support file type !')
        }else
        {
            var reader = new FileReader();
            reader.onload = function (e) {
               filesize = (e.total/1000) + ' KB'
               $('#file_name').text(file.name)
               $('#file_size').text(filesize)
               $('#image-holder').find('img').attr('src', e.target.result)
               $('.start').removeAttr('disabled')
            }
            reader.readAsDataURL(file);
        }
    }
    $scope.submit = function()
    {
        $scope.refresh = 1
        var data = new FormData();
        data.append('filename', file.name);
        data.append('file', file);
        FileManagerServices.uploadSingleFile(data).success(function(res){
            $scope.refresh = 0
            if(res.status == 'OK')
            {
                $('.start').attr('disabled', '')
                $('#file_name').text('')
                $('#file_size').text('')
                $('#image-holder').find('img').attr('src', '')
                $scope.success = 1
                $timeout(function() {
                       $scope.success = 0
                       $window.location.reload();
                    }, 2000);

            }else
            {
                $scope.error = 1
                $('.start').attr('disabled', '')
            }
        });
    }
    $scope.images = [];
    $('.show_image').hide();
    FileManagerServices.getAll(folder).success(function(res){      
        $scope.images = res
        if(res.length > 0)
        {
            $('.show_image').show();
        }
    });

    $scope.getImage = function(img)
    {
        localStorage.selectImage = $(img).attr('src')
    }      
});

