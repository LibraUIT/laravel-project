'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Content controllers of the application.
 */

/**
* Default Content controller
*/
laravelAdminApp.controller("ContentController", function($scope, $rootScope, $timeout, $routeParams, $route, $location) {
	$scope.template = {
                name: 'content.html',
                url: 'views/pages/content/content.html'};
    var params = $location.path().split('/')
    codeawesome.activeMenu(params[1])
    switch(params[2])
    {
    	case 'category':
    			$scope.subtemplate = {
                name: 'content.category.html',
                url: 'views/pages/content/content.category.html'};
                $scope.breacum_active = 'Category'
    	        break;

    }
                 

});


/**
* Content category controller
*/
laravelAdminApp.controller("ContentCategoryController", function($scope, $rootScope, $timeout, ContentServices) {
    $scope.createNewCategory = function()
    {
        console.log('ds')
    }
    $scope.submitCategory = function()
    {
        var form_string = $("#form" ).serialize();
        ContentServices.addCategory(form_string).success(function(res){
            console.log(res)
        })
    }
    
});


