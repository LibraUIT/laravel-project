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
        case 'post':
                $scope.subtemplate = {
                name: 'content.post.html',
                url: 'views/pages/content/content.post.html'};
                $scope.breacum_active = 'Posts'
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
    categoryList()
    $scope.createNewCategory = function()
    {
        $scope.showCreateCategory = 1
    }
    $scope.cancelNewCategory = function()
    {
        $scope.showCreateCategory = 0
        $('.start, .edit').removeAttr('disabled')
    }
    $scope.submitCategory = function()
    {
        var datatype = $('.save').attr('datatype');
        var form_string = $("#form" ).serialize();
        $scope.refresh = 1
        switch(datatype)
        {
            case 'new':
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
                break;
            case 'edit':
                var form_string = 'id=' + $scope.form.id + '&' +form_string
                ContentServices.editCategory(form_string).success(function(res){
                    if(res.status == 'OK')
                    {
                        categoryList()
                        $scope.success = 1
                        $scope.refresh = 0
                        $timeout(function() {
                            $scope.success = 0
                            $scope.showCreateCategory = 0
                            $('.save').attr('datatype', 'new')
                            $('.start, .edit').removeAttr('disabled')
                        }, 2000); 
                    }
                })
                break;    
        }
            
    }
    $scope.editCategory =  function(input)
    {
        $('.start, .edit').attr('disabled', '')
        var categoryId = parseInt( $(input).attr('id').split('-')[1] );
        ContentServices.getCategoryById(categoryId).success(function(res){
            if(res.status == 'OK')
            {
                $scope.showCreateCategory = 1
                $scope.form = res.data
                $scope.parent_category.selectedOption = {id: $scope.form.parent, name: 'Select Parent Category'}
                $timeout(function() {
                        $('.save').attr('datatype', 'edit')
                        if($scope.form.status == 1)
                        {
                            $('input[type=checkbox]').iCheck('check');
                        }else
                        {
                            $('input[type=checkbox]').iCheck('uncheck');
                        }
                    }, 0); 
            }
        })
    }

    // show category list
    function categoryList()
    {
        ContentServices.getAllCategory().success(function(res){
        if(res.status == 'OK')
        {
            $scope.categoryList = res.data
        }
    })
    }
    
});

/**
* Content post controller
*/
laravelAdminApp.controller("ContentPostController", function($scope, $rootScope, $timeout, ContentServices) {
    applyEditor()
    var $modal = $('.modal') 
    folder = 'post'
    $scope.showCreatePost = 0
    $scope.form = {
        image : '../storage/app/default/images/image_not_found.jpg'
    }
    ContentServices.getAllCategory().success(function(res){
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
    $scope.showModal = function(input)
    {
        $modal.modal('show')
        $viewImage = input
    }

    function applyEditor()
    {
        $timeout(function() {
            CKEDITOR.replace('form_content');                  
        }, 0); 
    }
    
});


