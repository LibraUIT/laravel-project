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
* Default Settings controller
*/
laravelAdminApp.controller("SettingsController", function($scope, $rootScope, $timeout, $routeParams, $route, $location) {
	$scope.template = {
                name: 'settings.html',
                url: 'views/pages/settings/settings.html'};
    var params = $location.path().split('/')
    codeawesome.activeMenu(params[1])
    switch(params[2])
    {
    	case 'general':
    			$scope.subtemplate = {
                name: 'settings.general,html',
                url: 'views/pages/settings/settings.general.html'};
                $scope.breacum_active = 'General'
    	break;

    }         
               

});


/**
* Main slider widget controller
*/
laravelAdminApp.controller("GeneralSettingsController", function($scope, $rootScope, $timeout, SettingsServices ) {
    folder = 'setting'
    $modal = $('.image_manager_modal')
    $scope.showModal = function(input)
    {
        $modal.modal('show')
        $viewImage = input
    }
    $scope.submit = function()
    {
        var form_string = $("#form" ).serialize();
        SettingsServices.setGeneral(form_string).success(function(res){
            if(res.status == 'OK')
            {
                $scope.success = 1
                $timeout(function() {
                    $scope.success = 0
                }, 2000);
            }
        });
    }
    SettingsServices.getGeneral().success(function(res){
        if(res.status == 'OK')
        {
            var form_data = res.data;
            $scope.formdata = form_data; 
        }
    });
});
