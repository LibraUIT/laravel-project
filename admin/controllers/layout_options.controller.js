'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Layout Options controllers of the application.
 */

/**
* Default Layout Options controller
*/
laravelAdminApp.controller("LayoutOptionsController", function($scope, $rootScope, $timeout, $routeParams, $route, $location) {
	$scope.template = {
                name: 'layout_options.html',
                url: 'views/pages/layout_options/layout_options.html'};
    var params = $location.path().split('/')
    codeawesome.activeMenu(params[1])
    switch(params[2])
    {
    	case 'home_page':
    			$scope.subtemplate = {
                name: 'layout_options.home_page.html',
                url: 'views/pages/layout_options/layout_options.home_page.html'};
                $scope.breacum_active = 'Home page'
    	break;

    }          
               

});


/**
* Home pgae Layout Options controller
*/
laravelAdminApp.controller("HomePageLayoutOptionsController", function($scope, $rootScope, $timeout ,LayoutOptionsServices) {
	$scope.heading_title = 'Home page setting layout'
	$scope.refresh = 0
	$scope.success = 0
	$timeout(function() {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    }, 0);
 	
 	/**
 	* default variable
 	*/

    $scope.formcheck = {
    	main_slider : false,
    	welcome_section : false,
    	hotel_facilities_section : false,
    	about_us_section : false,
    	contact_bottom : false,
        booking : false,
        bookingwithspecial : false,
        pinterest : false
    }
    getHomePageLayoutOption()

    $scope.submit = function()
    {
    	$scope.refresh = 1;
    	setHomePageLayoutOption($scope.formcheck)
    }

    /**
    * get Home page layout option function
    */
    function getHomePageLayoutOption()
    {
    	LayoutOptionsServices.getHomePageLayoutOption()
    		.success(function(res){
    			if(res.status === 'OK')
    			{
    				$scope.formcheck = res.data
    			}
    		})
    		.error(function(mes){

    		});
    }

    /**
    * set Home page layout option funciton
    */
    function setHomePageLayoutOption(input)
    {
    	LayoutOptionsServices.setHomePageLayoutOption(input)
    		.success(function(res){
    			if(res.status === 'OK')
    			{
    				$scope.refresh = 0
    				$scope.success = 1
	                $timeout(function() {
	                   $scope.success = 0
	                }, 2000);
    			}
    		})
    		.error(function(mes){

    		});
    }
});