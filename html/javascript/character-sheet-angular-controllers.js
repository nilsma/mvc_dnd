var myApp = angular.module('myApp', []);

myApp.factory('itemGetter', function($http) {
    return {
        getItemData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'items',
                decode: false,
                data: null
            });
        }
    };
});

myApp.factory('shieldGetter', function($http) {
    return {
        getShieldData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'shield',
                decode: false,
                data: null
            });
        }
    };
});

myApp.factory('armorGetter', function($http) {
    return {
        getArmorData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'armor',
                decode: false,
                data: null
            });
        }
    };
});

myApp.factory('skillGetter', function($http) {
    return {
        getSkillData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'skills',
                decode: false,
                data: null
            });
        }
    };
});

myApp.factory('savingThrowGetter', function($http) {
    return {
        getSavingThrowData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'saving_throws',
                decode: false,
                data: null
            });
        }
    };
});

myApp.factory('attributeGetter', function($http) {
    return {
        getAttributeData: function() {
            return $http.post('../character-sheet.php', {
                action: 'select',
                segment: 'attributes',
                decode: false,
                data: null
            });
        }
    };
});

myApp.controller('MainCtrl', ['$scope', 'attributeGetter', 'savingThrowGetter', 'skillGetter', 'itemGetter', 'armorGetter', 'shieldGetter', function($scope, attributeGetter, savingThrowGetter, skillGetter, itemGetter, armorGetter, shieldGetter) {
    var handleAttributeSuccess = function(data) {
        $scope.strength_base = data['strength']['ability_score'];
        //$scope.strength_ability_mod = $scope.getAbilityModifier($scope.strength_base);
        $scope.strength_temp_score = data['strength']['temp_score'];

        $scope.constitution_base = data['constitution']['ability_score'];
        //$scope.constitution_ability_mod = $scope.getAbilityModifier($scope.constitution_base);
        $scope.constitution_temp_score = data['constitution']['temp_score'];

        $scope.dexterity_base = data['dexterity']['ability_score'];
        //$scope.dexterity_ability_mod = $scope.getAbilityModifier($scope.dexterity_base);
        $scope.dexterity_temp_score = data['dexterity']['temp_score'];

        $scope.intelligence_base = data['intelligence']['ability_score'];
        //$scope.intelligence_ability_mod = $scope.getAbilityModifier($scope.intelligence_base);
        $scope.intelligence_temp_score = data['intelligence']['temp_score'];

        $scope.wisdom_base = data['wisdom']['ability_score'];
        //$scope.wisdom_ability_mod = $scope.getAbilityModifier($scope.wisdom_base);
        $scope.wisdom_temp_score = data['wisdom']['temp_score'];

        $scope.charisma_base = data['charisma']['ability_score'];
        //$scope.charisma_ability_mod = $scope.getAbilityModifier($scope.charisma_base);
        $scope.charisma_temp_score = data['charisma']['temp_score'];
    };

    var handleAttributeError = function() {
        alert('get attribute error');
    };

    var handleSavingThrowSuccess = function(data) {
        $scope.fortitude_base_save = data['fortitude']['base_save'];
        //$scope.fortitude_ability_mod = $scope.constitution_ability_mod;
        //$scope.fortitude_ability_mod = $scope.getAbilityModifier($scope.constitution_base);
        $scope.fortitude_magic_mod = data['fortitude']['magic_mod'];
        $scope.fortitude_misc_mod = data['fortitude']['misc_mod'];
        $scope.fortitude_temp_mod = data['fortitude']['temp_mod'];

        $scope.reflex_base_save = data['reflex']['base_save'];
        //$scope.reflex_ability_mod = $scope.dexterity_ability_mod;
        $scope.reflex_magic_mod = data['reflex']['magic_mod'];
        $scope.reflex_misc_mod = data['reflex']['misc_mod'];
        $scope.reflex_temp_mod = data['reflex']['temp_mod'];

        $scope.will_base_save = data['will']['base_save'];
        //$scope.will_ability_mod = $scope.wisdom_ability_mod;
        $scope.will_magic_mod = data['will']['magic_mod'];
        $scope.will_misc_mod = data['will']['misc_mod'];
        $scope.will_temp_mod = data['will']['temp_mod'];
    };

    var handleSavingThrowError = function() {
        alert('get saving throw error');
    };

    var handleSkillSuccess = function(data) {
        $scope.skills_array = data;
    };

    var handleSkillError = function() {
        alert('get skill error');
    };

    var handleItemSuccess = function(data) {
        for(var i = 0; i < data.length; i++) {
            data[i]['item_weight'] = parseFloat(data[i]['item_weight']);
        }
        $scope.items_array = data;
    };

    var handleItemError = function() {
        alert('get items error');
    };

    var handleArmorSuccess = function(data) {
        $scope.armor_weight = data['armor_weight'];
    };

    var handleArmorError = function() {
        alert('get armor error');
    };

    var handleShieldSuccess = function(data) {
        $scope.shield_weight = data['shield_weight'];
    };

    var handleShieldError = function() {
        alert('get shield error');
    };

    attributeGetter.getAttributeData().success(handleAttributeSuccess).error(handleAttributeError);
    savingThrowGetter.getSavingThrowData().success(handleSavingThrowSuccess).error(handleSavingThrowError);
    skillGetter.getSkillData().success(handleSkillSuccess).error(handleSkillError);
    itemGetter.getItemData().success(handleItemSuccess).error(handleItemError);
    armorGetter.getArmorData().success(handleArmorSuccess).error(handleArmorError);
    shieldGetter.getShieldData().success(handleShieldSuccess).error(handleShieldError);

    //calculate the saving throw ability modifier
    $scope.getSavingThrowAbilityModifier = function(key) {
        $scope.saving_throw_modifier = 0;
        if(key == 'fortitude') {
            $scope.saving_throw_modifier = Math.floor(($scope.constitution_base - 10) / 2);
        } else if(key == 'reflex') {
            $scope.saving_throw_modifier = Math.floor(($scope.dexterity_base - 10) / 2);
        } else if(key == 'will') {
            $scope.saving_throw_modifier = Math.floor(($scope.wisdom_base - 10) / 2);
        }

        return $scope.saving_throw_modifier;
    };

    //calculate the attribute's ability modifier
    $scope.getAbilityModifier = function(x) {
        if(x < 1) {
            return 0;
        } else {
            return Math.floor((x - 10) / 2);
        }
    };

    //get the skill ability modifier
    $scope.getSkillAbilityModifier = function(key) {
        $scope.skill_modifier = 0;
        if(key == 'STR') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.strength_base);
        } else if(key == 'CON') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.constitution_base);
        } else if(key == 'DEX') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.dexterity_base);
        } else if(key == 'INT') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.intelligence_base);
        }  else if(key == 'WIS') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.wisdom_base);
        }   else if(key == 'CHA') {
            $scope.skill_modifier = $scope.getAbilityModifier($scope.charisma_base);
        }

        return $scope.skill_modifier;
    };

    //calculate the skill mod total
    $scope.getSkillTotal = function(ability_mod, ranks, misc_mod) {
        return (ability_mod + ranks + misc_mod);
    };

    //calculate the saving throw's sum
    $scope.sumSavingThrow = function(base_save, ability_mod, magic_mod, misc_mod, temp_mod) {
        return (base_save + ability_mod + magic_mod + misc_mod + temp_mod);
    };

    //calculate item weight
    $scope.calculateItemWeight = function(quantity, weight) {
        return (quantity * weight);
    };

    //calculate character total weight
    $scope.sumCharacterTotal = function() {
        $scope.itemsTotal = $scope.sumItemsTotal();
        $scope.itemsTotal = parseFloat($scope.itemsTotal);
        armor_weight = parseFloat($scope.armor_weight);
        shield_weight = parseFloat($scope.shield_weight);
        return $scope.itemsTotal+$scope.armor_weight+$scope.shield_weight;
    };

    //calculate items total weight
    $scope.sumItemsTotal = function() {
        var sumItemsTotal = 0;
        for(var i = 0; i < $scope.items_array.length; i++) {
            var quantity = $scope.items_array[i]['item_quantity'];
            var weight = parseFloat($scope.items_array[i]['item_weight']);
            sumItemsTotal += $scope.calculateItemWeight(quantity, weight);
        }

        sumItemsTotal = sumItemsTotal.toFixed(2);
        return sumItemsTotal;
    }
}]);