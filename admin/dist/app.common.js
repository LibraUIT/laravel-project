'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Main module of the application.
 * Important
 */

 /**
 * Global varibles
 */
 var urlBase    = 'http://localhost/lar5';
 var urlBaseApi = [urlBase, 'api'].join('/');
 var folder , $modal, $viewImage, $elementId;
 var quan ;
 localStorage.setItem("selectImage", "");
 
 /**
 * Create new Angularjs App
 */
 var laravelAdminApp = angular.module('laravelAdminApp',[
 		'oc.lazyLoad',
 		'ui.router',
        'ngRoute',
        'datatables',
        'satellizer',
        'ngMessages'
 ]).config(['$stateProvider','$urlRouterProvider','$ocLazyLoadProvider', '$authProvider', function($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, $authProvider){
    
    /**
    * config authenticate api
    */
    $authProvider.loginUrl = urlBase + '/api/authenticate';

    $ocLazyLoadProvider.config({
      debug:false,
      events:true,
    });
 	/**
 	* Default route for laravelAdminApp
 	*/
 	$urlRouterProvider.otherwise('/login');

 	$stateProvider

 		/**
 		* Route for Dashboard page
 		*/
 		.state('dashboard',{
 			url:'/dashboard',
        	templateUrl: 'views/layout/main.html',
        	controller: 'DashboardController'
 		})

 		/**
 		* Route for Login page
 		*/
 		.state('login',{
 			url:'/login',
 			templateUrl: 'views/pages/login.html',
 			controller: 'LoginController',
 			resolve: {
        		loadMyDirectives:function($ocLazyLoad){
        			return $ocLazyLoad.load(
        			{
        				name:'login',
        				files:[
			 			'plugins/iCheck/icheck.min.js',
			 			'dist/js/pages/login.js',
			 			'plugins/iCheck/square/blue.css',
			 			'dist/css/style.login.css'
			 			]
        			})
        		}
        	}
 			
 		})

        // Layout Options
        .state('layout_options', {
            url: '/layout_options',
            templateUrl: 'views/layout/main.html',
            controller: 'LayoutOptionsController'
        })
            // Layout options for home page
            .state('layout_options.home_page', {
                url: '/home_page',
                resolve: {
                    loadMyDirectives:function($ocLazyLoad){
                        return $ocLazyLoad.load(
                        {
                            name:'layout_options_home_page',
                            files:[
                            'plugins/iCheck/square/blue.css',
                            'plugins/iCheck/icheck.min.js'
                            ]
                        })
                    }
                }
            })

        // Widgets
        .state('widgets', {
            url: '/widgets',
            templateUrl: 'views/layout/main.html',
            controller: 'WidgetsController'
        })

            // Main slider widget
            .state('widgets.main_slider', {
                url: '/main_slider'
            })

            // Gallery widget
            .state('widgets.gallery', {
                url: '/gallery'
            })

            // Hotel Facilties widget
            .state('widgets.hotel_facilties', {
                url: '/hotel_facilties',
                resolve: {
                    loadMyDirectives:function($ocLazyLoad){
                        return $ocLazyLoad.load(
                        {
                            name:'hotel_facilties',
                            files:[
                            'plugins/iCheck/square/blue.css',
                            'plugins/iCheck/icheck.min.js'
                            ]
                        })
                    }
                }
            })

        // Content
        .state('content', {
            url: '/content',
            templateUrl: 'views/layout/main.html',
            controller: 'ContentController'
        })

            // Category Content
            .state('content.category', {
                url: '/category',
                resolve: {
                    loadMyDirectives:function($ocLazyLoad){
                        return $ocLazyLoad.load(
                        {
                            name:'category',
                            files:[
                            'plugins/iCheck/square/blue.css',
                            'plugins/iCheck/icheck.min.js'
                            ]
                        })
                    }
                }
            })

            // Post Content
            .state('content.post', {
                url: '/post',
                resolve: {
                    loadMyDirectives:function($ocLazyLoad){
                        return $ocLazyLoad.load(
                        {
                            name:'post',
                            files:[
                            'plugins/iCheck/square/blue.css',
                            'plugins/iCheck/icheck.min.js',
                            'plugins/ckeditor/ckeditor.js'
                            ]
                        })
                    }
                }
            })

            

        // File manager
        .state('file_manager', {
            url: '/file_manager',
            templateUrl: 'views/layout/main.html',
            controller: 'FileManagerController'
        })
        .state('image_manager', {
            url: '/image_manager',
            templateUrl: 'views/pages/file_manager/image_manager.html',
            controller: 'ImageManagerController'
        })

        // Settings
        .state('settings', {
            url: '/settings',
            templateUrl: 'views/layout/main.html',
            controller: 'SettingsController'
        })
            // General setting
            .state('settings.general', {
                url: '/general'
            })
 }]);


/**
*   Code Awesome Function
*/

var CodeAwesome = function (input)
{
    this.input = input;
    this.URL   = document.URL;
};

// active menu function of Code Awesome Function

CodeAwesome.prototype.activeMenu = function(menu)
{
    $('.treeview').removeClass('active');
    setTimeout(function(){ $('#'+menu).addClass('active'); }, 500);
}

// start code awesome function

var codeawesome = new CodeAwesome('');

// File Manager Common Function

function FileManager($scope)
{
    $scope.getImage = function(input)
    {
        var imageUrl = $(input).attr('src');
        $($viewImage).find('img').attr('src', imageUrl);
        $($viewImage).find('input').attr('value', imageUrl);
        $modal.modal('hide');
    }
}


// Validate Email function
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

// Scroll to top
function scrollToTop()
{
    $("html, body").animate({
        scrollTop: 0
    }, 600);
}


function checkIssetRow()
    {
        var countItem = $('.rowitem').length;
        if(countItem > 1)
        {
            $('.save').removeAttr('disabled')
        }else
        {
            $('.save').attr('disabled', '')
        }
    }
// Clear console after 5s    
function clearConsole()
{
    console.clear();
    setTimeout(function(){ console.clear(); }, 5000);
} 
//clearConsole();   

