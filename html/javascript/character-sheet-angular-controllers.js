var myApp = angular.module('myApp', []);

myApp.controller('AttributeCtrl', ['$scope', function($scope) {
    $scope.getAbilityModifier = function(data) {
        if(data < 1) {
            return 0;
        } else {
            return Math.floor((data - 10) / 2);
        }
    }
}]);

myApp.controller('SavingThrowCtrl', ['$scope', function($scope) {
    $scope.sumSavingThrow = function(base_save, ability_mod, magic_mod, misc_mod, temp_mod) {
        return (base_save + ability_mod + magic_mod + misc_mod + temp_mod);
    }
}]);