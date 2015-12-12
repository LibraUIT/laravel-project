'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Common directives of the application.
 */
 /**
 * Important
 * Load Layout for App
 */
 laravelAdminApp.directive('loadLayout', function() {
 	return {
 		restrict: 'A',
	    transclude: true,
	    scope: {},
	    link: function(scope, element, attrs)
	    {
            /**
	    	* Toggle control-siderbar-dark function
	    	*/
	    	scope.headerSlidebarToggle = function()
	    	{
	    		var $sidebarMini = $('.sidebar-mini')
	    		if($sidebarMini.hasClass('sidebar-collapse'))
	    		{
	    			$sidebarMini.removeClass('sidebar-collapse')
	    		}else
	    		{
	    			$sidebarMini.addClass('sidebar-collapse')
	    		}
	    		
	    	}

	    },
	    template: 
	    "<div class=\"wrapper\">"+
	    "<div ui-view class=\"uiview\"></div>"+
	    "</div>"
 	}
 })
 // Column Left Menu
 .directive('columnLeft', function($rootScope, $location, $route , $auth, $state) {
    return {
        restrict: 'A',
        transclude: true,
        scope: {},
        link: function(scope, element, attrs)
        {
            /**
            * Check isset Authenticate
            */
            if($auth.isAuthenticated() != true)
            {
                $state.go('login', {});
            }
            
            scope.loadView = function(input)
            {
              $rootScope.$apply(function() {

                $location.path("/");
              });
            }
        },
        templateUrl: 'views/layout/left_menu.html'
    }
 })
// iCheck 
 .directive('icheck', function ($timeout, $parse) {
    return {
        require: 'ngModel',
        link: function ($scope, element, $attrs, ngModel) {
            return $timeout(function () {
                var value;
                value = $attrs['value'];

                $scope.$watch($attrs['ngModel'], function (newValue) {
                    $(element).iCheck('update');
                });

                $scope.$watch($attrs['ngDisabled'], function (newValue) {
                    $(element).iCheck(newValue ? 'disable' : 'enable');
                    $(element).iCheck('update');
                })

                return $(element).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'

                }).on('ifChanged', function (event) {
                    if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                        $scope.$apply(function () {
                            return ngModel.$setViewValue(event.target.checked);
                        })
                    }
                }).on('ifClicked', function (event) {
                    if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                        return $scope.$apply(function () {
                            //set up for radio buttons to be de-selectable
                            if (ngModel.$viewValue != value)
                                return ngModel.$setViewValue(value);
                            else
                                ngModel.$setViewValue(null);
                            ngModel.$render();
                            return
                        });
                    }
                });
            });
        }
    };
}).directive('alertSuccess', function($timeout, $route) {
    return {
        restrict: 'A',
        transclude: true,
        link: function($scope, element, attrs)
        {
                
           
        },
        templateUrl: 'views/modules/alert_success.html'
    }
 }).directive('alertError', function($timeout, $route) {
    return {
        restrict: 'A',
        transclude: true,
        link: function($scope, element, attrs)
        {
                
           
        },
        templateUrl: 'views/modules/alert_error.html'
    }
 }).directive('imageManager', function($timeout, $route, FileManagerServices) {
    return {
        restrict: 'A',
        transclude: true,
        link: function($scope, element, attrs)
        {
            var file, resultHTML = ''
            resultHTML = '<table class="result_image_manager">'
            FileManagerServices.getAll(folder).success(function(res){      
                if(res.length > 0)
                {
                    for(var i = 0 ; i < res.length; i++)
                    {
                        var image = res[i];
                        resultHTML +='<tr>'+
                                     '<td class="first-column resultHTML">'+
                                     '<img  class="result_image" src="../storage/app/'+image.file_path+'" onClick="angular.element(this).scope().getImage(this)">'+
                                     '</td>'+
                                     '<td class="second-column resultHTML"><b>'+image.file_name+'</b></td>'+
                                     '<td class="tree-column resultHTML">'+image.file_size+'</td>'+
                                     '<td class="last-column resultHTML"><button type="button" onclick="angular.element(this).scope().deleteImage(\''+image.file_path+'\')" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash"></i></button></td>'+
                                     '</tr>';   
                    }
                    resultHTML += '</table>';
                    $('.show_image').html(resultHTML)
                }else
                {
                    $('.show_image').html('<h3>Empty ! Please upload image.</h3>')
                }

            });
            $scope.addFile = function(input) {
                var files = document.getElementById($(input).attr('id')).files; 
                file = files[0]
                var rule = ['image/jpeg', 'image/png']
                if( rule.indexOf(file.type) < 0)
                {
                    alert('No support file type !')
                }else
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                       $('.start').removeAttr('disabled')
                    }
                    reader.readAsDataURL(file);
                }
            }
            $scope.submit = function()
            {
                $scope.refresh = 1
                var data = new FormData();
                data.append('folder', folder);
                data.append('filename', file.name);
                data.append('file', file);
                FileManagerServices.uploadSingleFile(data).success(function(res){
                    $scope.refresh = 0
                    if(res.status == 'OK')
                    {
                        $('.start').attr('disabled', '')
                        FileManagerServices.getAll(folder).success(function(res){      
                            if(res.length > 0)
                            {
                                resultHTML = '<table class="result_image_manager">'
                                for(var i = 0 ; i < res.length; i++)
                                {
                                    var image = res[i];
                                    resultHTML +='<tr>'+
                                                 '<td class="first-column resultHTML">'+
                                                 '<img  class="result_image" src="../storage/app/'+image.file_path+'" onClick="angular.element(this).scope().getImage(this)">'+
                                                 '</td>'+
                                                 '<td class="second-column resultHTML"><b>'+image.file_name+'</b></td>'+
                                                 '<td class="tree-column resultHTML">'+image.file_size+'</td>'+
                                                 '<td class="last-column resultHTML"><button type="button" onclick="angular.element(this).scope().deleteImage(\''+image.file_path+'\')" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash"></i></button></td>'+
                                                 '</tr>';    
                                }
                                resultHTML += '</table>';
                                $('.show_image').html(resultHTML)
                            }else
                            {
                                $('.show_image').html('<h3>Empty ! Please upload image.</h3>')
                            }

                        });
                    }else
                    {
                        $scope.error = 1
                        $('.start').attr('disabled', '')
                    }
                });
            }
            FileManager($scope);
            $scope.deleteImage =  function(image)
            {
                image = image.split('/');

                var data = new FormData();
                data.append('folder', folder);
                data.append('image', image[image.length-1]);
                FileManagerServices.deleteSingleFile(data).success(function(res){
                    if(res.status == 'OK')
                    {
                        FileManagerServices.getAll(folder).success(function(res){      
                            if(res.length > 0)
                            {
                                resultHTML = '<table class="result_image_manager">'
                                for(var i = 0 ; i < res.length; i++)
                                {
                                    var image = res[i];
                                    resultHTML +='<tr>'+
                                                 '<td class="first-column resultHTML">'+
                                                 '<img  class="result_image" src="../storage/app/'+image.file_path+'" onClick="angular.element(this).scope().getImage(this)">'+
                                                 '</td>'+
                                                 '<td class="second-column resultHTML"><b>'+image.file_name+'</b></td>'+
                                                 '<td class="tree-column resultHTML">'+image.file_size+'</td>'+
                                                 '<td class="last-column resultHTML"><button type="button" onclick="angular.element(this).scope().deleteImage(\''+image.file_path+'\')" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash"></i></button></td>'+
                                                 '</tr>';    
                                }
                                resultHTML += '</table>';
                                $('.show_image').html(resultHTML)
                            }else
                            {
                                $('.show_image').html('<h3>Empty ! Please upload image.</h3>')
                            }

                        });
                    }
                });
            }    
           
        },
        templateUrl: 'views/modules/single_upload.html'
        
    }
 }).directive('myLink', function() {
  return {
    restrict: 'A',
    scope: {
      enabled: '=myLink'
    },
    link: function(scope, element, attrs) {
      element.bind('click', function(event) {
        if(!scope.enabled) {
          event.preventDefault();
        }
      });
    }
  };
})
 // Directive using https://codyhouse.co/gem/simple-confirmation-popup/
 .directive('cdPopup', function(WidgetsServices, ContentServices, CatalogServices, $route) {
  return {
    restrict: 'A',
    transclude: true,
        link: function($scope, element, attrs)
        {
            var $isVisible = function(){ $('.cd-popup').addClass('is-visible'); }    
            var $isNotVisible = function(){ $('.cd-popup').removeClass('is-visible'); }
            $scope.showPopup = function(input)
            {
                $elementId = $(input).attr('id');
                $isVisible();
            }
            
            $scope.confirmYes = function()
            {
                event.preventDefault();
                var elements = $elementId.split('-');
                switch(elements[0])
                {
                    case "gallery": // Delete gallery 
                        var galleryId = parseInt(elements[1]);
                        WidgetsServices.deleteGallery(galleryId).success(function(res){
                            console.log(res);
                            $('#'+$elementId).parent().parent().remove();
                            $isNotVisible();
                        });
                        break;
                    case "hotel_faciltie":
                        var hotel_faciltieId = parseInt(elements[1]);
                        WidgetsServices.deleteHotelFacilties(hotel_faciltieId).success(function(res){
                            console.log(res);
                            $('#'+$elementId).parent().parent().remove();
                            $isNotVisible();
                        });
                        break;
                    case "remove_background_hotel_facilties":
                        WidgetsServices.removeBackgroundHotelFacilties().success(function(res){
                            $isNotVisible();
                            if(res.status == 'OK')
                            {
                               $('#'+$elementId).parent().parent().find('img').attr('src', '../storage/app/default/images/image_not_found.jpg'); 
                               $('#'+$elementId).parent().parent().find('input[type=text]').attr('value', '');
                            }
                        })
                        break;
                    case "category":
                        var categoryId = parseInt(elements[1]);
                        ContentServices.deleteCategoryById(categoryId).success(function(res){
                            $isNotVisible();
                            if(res.status == 'OK')
                            {
                               $('#'+$elementId).parent().parent().remove();
                            }
                        })
                        break;
                    case "post":
                        var postId = parseInt(elements[1]);
                        ContentServices.deletePostById(postId).success(function(res){
                            $isNotVisible();
                            if(res.status == 'OK')
                            {
                               $('#'+$elementId).parent().parent().remove();
                            }
                        })
                        break;
                    case "product":
                        var productId = parseInt(elements[1]);
                        CatalogServices.deleteProductById(productId).success(function(res){
                            $isNotVisible();
                            if(res.status == 'OK')
                            {
                               $('#'+$elementId).parent().parent().remove();
                            }
                        })
                        break;                    
                }
            }
            $scope.confirmNo = function()
            {
                event.preventDefault();
                $isNotVisible();
            }

            jQuery(document).ready(function($){
            //open popup
            /*$('.cd-popup-trigger').on('click', function(event){
                event.preventDefault();
                $('.cd-popup').addClass('is-visible');
            });*/
            
            //close popup
            $('.cd-popup').on('click', function(event){
                if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
                    event.preventDefault();
                    $isNotVisible();
                }
            });
            //close popup when clicking the esc keyboard button
            $(document).keyup(function(event){
                if(event.which=='27'){
                    $isNotVisible();
                }
            });
          });
        },
        templateUrl: 'views/modules/cd_popup.html'
  };
})