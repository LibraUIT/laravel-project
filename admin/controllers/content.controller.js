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
        $('.save').attr('datatype', 'new')
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
    var curentPage = 1 , limit = 5 , pagination = '?limit=' + limit +'&page=' + curentPage;
    getAllPostByPanigation(pagination)
    $modal = $('.modal') 
    folder = 'post'
    $scope.showCreatePost = 0
    $scope.form = {
        cover : '../storage/app/default/images/image_not_found.jpg'
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
    $scope.createNewPost = function()
    {
        $('.save').attr('datatype', 'new')
        $scope.showCreatePost = 1
        applyEditor()
    }
    $scope.cancelNewPost = function()
    {
        $scope.showCreatePost = 0
        $('.start, .edit').removeAttr('disabled')
    }
    $scope.showModal = function(input)
    {
        $modal.modal('show')
        $viewImage = input
    }

    $scope.submitPostContent = function()
    {
        var datatype = $('.save').attr('datatype');
        var form_string = $("#form" ).serialize();
        $scope.refresh = 1
        switch(datatype)
        {
            case "new":
                form_string = 'user=' + localStorage.getItem("usrloinid") + '&' + form_string
                ContentServices.addPost(form_string).success(function(res){
                    if(res.status == 'OK')
                    {
                        $scope.success = 1
                        $scope.refresh = 0
                        $timeout(function() {
                            $scope.success = 0
                            $scope.showCreatePost = 0
                        }, 2000);

                    }
                })
                break;
            case 'edit':
                var form_string = 'id=' + $scope.form.id + '&user=' + localStorage.getItem("usrloinid") + '&' +form_string
                ContentServices.editPost(form_string).success(function(res){
                    if(res.status == 'OK')
                    {
                        getAllPostByPanigation(pagination)
                        $scope.success = 1
                        $scope.refresh = 0
                        $timeout(function() {
                            $scope.success = 0
                            $scope.showCreatePost = 0
                            $('.save').attr('datatype', 'new')
                            $('.start, .edit').removeAttr('disabled')
                        }, 2000);
                    }
                })
                break;      
        }
        getAllPostByPanigation(pagination) 
    }

    $scope.editPost = function(input)
    {
        $('.start, .edit').attr('disabled', '')
        var postId = parseInt( $(input).attr('id').split('-')[1] );
        ContentServices.getPostById(postId).success(function(res){
            if(res.status == 'OK')
            {
                $scope.showCreatePost = 1
                $scope.form = res.data
                $scope.form.content = $scope.form.content.replace('<p>', '');
                $scope.form.content = $scope.form.content.replace('</p>', '');
                $scope.parent_category.selectedOption = {id: $scope.form.category, name: 'Select Parent Category'}
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

    function applyEditor()
    {
        $timeout(function() {
            CKEDITOR.replace('form_content');                  
        }, 0); 
    }

    // Functions of gallery widget controller
    function getAllPostByPanigation(pagination)
    {
        ContentServices.getAllPostContent(pagination).success(function(res){
            if(res.data.length > 0)
            {
                $scope.posts = res.data;
                if(res.prev_page_url != null ){ $scope.prev_page_url = res.prev_page_url }
                if(res.next_page_url != null ){ $scope.next_page_url = res.next_page_url }
                $scope.last_page     = res.last_page;
                $scope.current_page  = res.current_page;
                $scope.total         = Math.ceil(res.total / limit );
            }
        });
    }
    
});


