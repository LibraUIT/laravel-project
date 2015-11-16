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
    $scope.showCreateCategory = 0
    ContentServices.getParentCategory().success(function(res){
       if(res.status == 'OK')
       {
            var defaultOption = { id : null, name : 'Select Parent Category' }
            var parent_category = res.data
            parent_category.push(defaultOption)
            $scope.parent_category = {
                selectedOption : {id: 'null', name: 'Select Parent Category'},
                availableOptions : parent_category
            }
       }
    })
    $scope.createNewCategory = function()
    {
        $scope.showCreateCategory = 1
    }
    $scope.cancelNewCategory = function()
    {
        $scope.showCreateCategory = 0
    }
    $scope.submitCategory = function()
    {
        var form_string = $("#form" ).serialize();
        $scope.refresh = 1
        ContentServices.addCategory(form_string).success(function(res){
            if(res.status == 'OK')
            {
                $scope.success = 1
                $scope.refresh = 0
                $timeout(function() {
                    $scope.success = 0
                    $scope.showCreateCategory = 0
                }, 2000); 
            }
        })
    }
    
});


