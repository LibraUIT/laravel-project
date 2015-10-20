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
* Default Widgets controller
*/
laravelAdminApp.controller("WidgetsController", function($scope, $rootScope, $timeout, $routeParams, $route, $location) {
	$scope.template = {
                name: 'widgets.html',
                url: 'views/pages/widgets/widgets.html'};
    var params = $location.path().split('/')
    codeawesome.activeMenu(params[1])
    switch(params[2])
    {
    	case 'main_slider':
    			$scope.subtemplate = {
                name: 'widgets.main_slider.html',
                url: 'views/pages/widgets/widgets.main_slider.html'};
                $scope.breacum_active = 'Main slider'
    	break;

    }         
               

});


/**
* Main slider widget controller
*/
laravelAdminApp.controller("MainSliderWidgetController", function($scope, $rootScope, $timeout ,WidgetsServices ) {
    $scope.heading_title = 'Banner Setting'
    folder = 'main_slider'
    $modal = $('.image_manager_modal')
    var resultHTML = '', rowId = 1;
    var rowHTML =  function(row, column1, column2, column3)
    {
        var html =              '<tr class="rowitem" id="row'+row+'">'+
                                '<td>'+row+'</th>'+
                                '<td><input value="'+column1+'" type="text" name="text" class="form-control" placeholder="Text" ></td>'+
                                '<td><input value="'+column2+'" type="text" name="link" class="form-control" placeholder="Link" ></td>'+
                                '<td>'+
                                '<a onclick="angular.element(this).scope().showModal(this)" id="thumb-image0" data-toggle="image" class="img-thumbnail" data-original-title="" title="">'+
                                '<img style="width:100px;height:100px;cursor: pointer;" src="'+column3+'" alt="" title="" data-placeholder="../storage/app/default/images/image_not_found.jpg">'+
                                '<input value="'+column3+'" style="display:none" type="text" name="image" >'+
                                '</a>'+                                  
                                '</td>'+
                                '<td>'+
                                '<button type="button" onclick="angular.element(this).scope().removeRow(this)" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button>'+
                                '</td>'+
                                '</tr>';
       return html; 
    }  
    $scope.showModal = function(input)
    {
        $modal.modal('show')
        $viewImage = input
    }
    $scope.removeRow = function(input)
    {
        $(input).parent().parent().remove();
    }
    $scope.addRow = function(input)
    {
        $(rowHTML(rowId, '', '', '../storage/app/default/images/image_not_found.jpg')).insertAfter( $(".rowitem").last());
        rowId++;
    }
    $scope.submit = function()
    {
        $scope.refresh = 1
        var form_string = $("#form" ).serialize();
        WidgetsServices.setMainSlider(form_string).success(function(res){
            if(res.status == 'OK')
            {
                    $scope.refresh = 0
                    $scope.success = 1
                    $timeout(function() {
                       $scope.success = 0
                    }, 2000);
            }
        });
    }
    WidgetsServices.getMainSlider().success(function(res){
        if(res.status == 'OK')
        {
            var rows = res.data;
            $.each(rows, function(key, value){
                $(rowHTML(rowId, value.text, value.link, value.image)).insertAfter( $(".rowitem").last());
                rowId++;
            });
        }
    });
});
