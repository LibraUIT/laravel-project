'use strict';
/**
 * @ngdoc overview
 * @name laravelAdminApp
 * @description
 * @author https://github.com/minhquan4080
 * # laravelAdminApp
 *
 * Login controller of the application.
 */
laravelAdminApp.controller("LoginController", function($scope, $rootScope, $timeout, $auth, $state, $http) {
	/**
    * Check isset Authenticate
    */
    if($auth.isAuthenticated() == true)
    {
        $state.go('dashboard', {});
    }	
	$('.uiview').addClass('uiviewlogin')
  	$timeout(function() {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    }, 0);
   
    $scope.auth = {
    	login : function()
    	{
    		var checkEmail = false, checkPass = false;
    		var vm = this;

    		if(vm.email == undefined ){ vm.email_fail = 'Please enter your email' }
    		else if(validateEmail(vm.email) != true ){ vm.email_fail = 'Email address is not in the correct format' }
    		else { checkEmail = true; }

    		if(vm.password == undefined ){ vm.password_fail = 'Please enter your password' }
    		else { checkPass = true; }
    		
    		if(checkEmail == true && checkPass == true )
    		{
    			var credentials = {
	                email: vm.email,
	                password: vm.password
	            }
	            
	            vm.refresh = 1;

	            quan = $auth.login(credentials).then(function(data) {
		            	return data;
		                // If login is successful, redirect to the users state
		                //$state.go('dashboard', {});
	           	});
	            $timeout(function() {
	            	if(quan.$$state.status == 2)
	            	{
	            		vm.refresh = 0;
	            		vm.login_fail = 'Email or password not match !';
	            	}else
	            	{
	            		$state.go('dashboard', {});
	            	}	            	
	            }, 3000);

    		}	
    		
    	}
    }

});