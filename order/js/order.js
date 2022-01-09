(function(){
    var is_valid = {};
    var app = angular.module('efruit', ['app.services']);
    app.controller('eFruitController', function($scope, myService){
        myService.init($scope);
    });
})();