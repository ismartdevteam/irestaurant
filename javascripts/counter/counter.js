app = angular.module("MyCount", ["ngDialog"]);

// all environments
// app.config(['$routeProvider',
//     function($routeProvider) {
     
//         $routeProvider.
//                 when('/HOME', {
//                     templateUrl: 'view/index.html',
//                     controller: 'CountCtrl'
//                 }).
           
//                 otherwise({
//                     redirectTo: '/HOME'
//                 });
               
//     }]);
    app.config(['ngDialogProvider', function (ngDialogProvider) {
            ngDialogProvider.setDefaults({
                className: 'ngdialog-theme-default',
                plain: false,
                showClose: true,
                closeByDocument: true,
                closeByEscape: true,
                appendTo: false,
                preCloseCallback: function () {
                    console.log('default pre-close callback');
                }
            });
        }]);



app.controller("CountCtrl", function($http, $scope,ngDialog) {


$scope.init = function (email) {

    $http.get("/datas/countEmailRegister/"+email).success(function(data) {
                console.log(data);
    
          var dialog = ngDialog.open({
                    template: 'Thank you for register your email',
                    plain: true,
                    closeByDocument: false,
                    closeByEscape: false
                });
                setTimeout(function () {
                    dialog.close();
                }, 2500);
                
            
        }).error(function(data) {
            console.log(data);
        });;
};

});





