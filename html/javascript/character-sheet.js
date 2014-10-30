//GLOBAL VARIABLES
var special_ability_template_name;
var feat_template_name;

/**
 * A function to add HTML as innerHTML to a given element
 * @param element the element to add HTML to
 * @param html the HTML to add to the element
 */
function addHTMLtoElement(element, html) {
    element.innerHTML=html;
}

/**
 * A function to check for confirmation on a given choice.
 * @param str the last part of the sentence to ask the user to confirm
 * @returns boolean true if the user accepts, false otherwise
 */
function confirmChoice(str) {
    return confirm('Are you sure you want to '.concat(str).concat(' ?'));
}

/**
 * A function to remove a given item from the database.
 * The function gets the item's SQL id from the HTML and removes the item from the database by sending
 * the id with the POST action to the governing PHP-file through the runQuery function
 */
function removeItem() {
    var post_action = "remove_item=";
    var item = this.parentNode.parentNode.childNodes[1].childNodes[0].value;
    if(confirmChoice('remove item')) {
        runQuery(post_action, item, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given currency from the database.
 * The function gets the currency's SQL label from the HTML and removes the currency from the database by
 * sending the label with the POST action to the governing PHP-file through the runQuery function
 */
function removeCurrency() {
    var post_action = "remove_currency=";
    var currency = this.parentNode.parentNode.childNodes[1].innerHTML;
    if(confirmChoice('remove currency')) {
        runQuery(post_action, currency, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given language from the database.
 * The function gets the language's SQL language value (the SQL column identifying the language is called
 * "language") from the HTML and removes the currency from the database by sending the label with the POST action
 * to the governing PHP-file through the runQuery function
 * Finally reloads the page to update the character sheet
 */
function removeLanguage() {
    var post_action = "remove_language=";
    var language = this.parentNode.childNodes[0].innerHTML;
    if(confirmChoice('remove language')) {
        runQuery(post_action, language, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given special ability from the database.
 * The function gets the special ability's SQL template name from the HTML and removes the currency from
 * the database by sending the template name with the POST action to the governing PHP-file
 * through the runQuery function.
 * Finally reloads the page to update the character sheet
 */
function removeSpecialAbility() {
    var post_action = "remove_special_ability=";
    if(confirmChoice('remove special ability')) {
        var template_name = this.parentNode.id;
        runQuery(post_action, template_name, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given feat from the database.
 * The function gets the feat's SQL template name from the HTML and removes the feat from
 * the database by sending the template name with the POST action to the governing PHP-file
 * through the runQuery function.
 * Finally reloads the page to update the character sheet
 */
function removeFeat() {
    var post_action = "remove_feat=";
    if(confirmChoice('remove feat')) {
        var template_name = this.parentNode.id;
        runQuery(post_action, template_name, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given protective item from the database.
 * The function gets the protective item's SQL id from the HTML and removes the protective item from
 * the database by sending the id with the POST action to the governing PHP-file
 * through the runQuery function.
 * Finally reloads the page to update the character sheet
 */
function removeProtectiveItem() {
    var post_action = "remove_protective_item=";
    if(confirmChoice('remove protective item')) {
        var protective_item_id = this.parentNode.parentNode.childNodes[1].value;
        runQuery(post_action, protective_item_id, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given attack from the database.
 * The function gets the attack's SQL id from the HTML and removes the attack from
 * the database by sending the id with the POST action to the governing PHP-file
 * through the runQuery function.
 * Finally reloads the page to update the character sheet
 */
function removeAttack() {
    var post_action = "remove_attack=";
    if(confirmChoice('remove attack')) {
        var attack_id = this.parentNode.parentNode.childNodes[1].value;
        runQuery(post_action, attack_id, function() {
            location.reload();
        });
    }
}

/**
 * A function to get a special ability's description and add it to the special ability description div.
 */
function showSpecialAbilityInfo() {
    var post_action = "special_ability_info=";
    var element = document.getElementById('special_ability_template_info');
    var template_name = this.parentNode.id;
    runQuery(post_action, template_name, true, function(info) {
        addHTMLtoElement(element, info);
    });
}

/**
 * A function to get a skill's description and add it to the skill description div.
 */
function showSkillInfo() {
    var post_action = "skill_info=";
    var element = document.getElementById('skill_template_info');
    var template_name = this.parentNode.parentNode.childNodes[1].value;
    runQuery(post_action, template_name, false, function(info) {
        addHTMLtoElement(element, info);
    });
}

/**
 * A function to get a feat's description and add it to the feat description div.
 */
function showFeatInfo() {
    var post_action = "feat_info=";
    var common_name = this.parentNode.id;
    var element = document.getElementById('feat_template_info')
    runQuery(post_action, common_name, false, function(info) {
        addHTMLtoElement(element, info);
    });
}


function closeSkillInfo() {
    var el = document.getElementById('skill_template_info');
    el.innerHTML='';
}

function closeSpecialAbilityInfo() {
    var el = document.getElementById('special_ability_template_info');
    el.innerHTML='';
}

function closeFeatInfo() {
    var el = document.getElementById('feat_template_info');
    el.innerHTML='';
}

/**
 * A function to find special ability temlates suggestions for the user
 * as the user adds text to search input field
 */
function findSpecialAbilitySuggestions() {
    var post_action = "get_special_abilities_suggestions=";
    var element = document.getElementById('special_abilities_suggestions_box');
    var input = this.value;
    runQuery(post_action, input, true, function(suggestions) {
        addHTMLtoElement(element, suggestions);
    });
}

/**
 * A function to find feat temlates suggestions for the user
 * as the user adds text to search input field
 */
function findFeatsSuggestions() {
    var post_action = "get_feat_suggestions=";
    var element = document.getElementById('feats_suggestions_box');
    var input = this.value;
    runQuery(post_action, input, true, function(suggestions) {
        addHTMLtoElement(element, suggestions);
    });
}

function chooseTemplate(base_class, template_name, common_name) {
    var element = document.getElementById('feats_suggestions_box');
    var displayed_node = document.getElementById('special_ability_search_input');
    var hidden_node = document.getElementById('special_ability_search_template');
    var input_base_class = document.getElementById('special_ability_search_base_class');
    setSpecialAbilitySuggestionToInput(base_class, template_name, common_name, displayed_node, hidden_node, input_base_class, function() {
        var emptyArray = new Array();
        addHTMLtoElement(element, emptyArray);
    });
}

function setSpecialAbilitySuggestionToInput(base_class, template_name, common_name, displayed_node, hidden_node, input_base_class, callback) {
    displayed_node.value=common_name;
    hidden_node.value=template_name;
    input_base_class.value=base_class;
    special_ability_template_name = template_name;
    callback();
}

function chooseFeatTemplate(template_name, common_name) {
    var displayed_node = document.getElementById('feats_search_input');
    var hidden_node = document.getElementById('feats_search_template');
    setFeatSuggestionToInput(template_name, common_name, displayed_node, hidden_node, function() {
        var emptyArray = new Array();
        addResultToFeatSuggestionsBox(emptyArray);
    });
}

function setFeatSuggestionToInput(template_name, common_name, displayed_node, hidden_node, callback) {
    displayed_node.value=common_name;
    hidden_node.value=template_name;
    feat_template_name = template_name;
    callback();
}

/**
 * A function to write all of the personalia fields' values to the database.
 */
function updatePersonalia() {
    getPersonaliaSegments(function(segments) {
        runQuery("update_personalia=", segments);
    });
}

/**
 * A function to get the personalia fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getPersonaliaSegments(callback) {
    var segments = new Object();

    segments.name = name = document.getElementById('personalia_name').value;
    segments.class = document.getElementById('personalia_class').value;
    segments.level = document.getElementById('personalia_level').value;
    segments.size = document.getElementById('personalia_size').value;
    segments.age = document.getElementById('personalia_age').value;
    segments.gender = document.getElementById('personalia_gender').value;
    segments.height = document.getElementById('personalia_height').value;
    segments.weight = document.getElementById('personalia_weight').value;
    segments.eyes = document.getElementById('personalia_eyes').value;
    segments.hair = document.getElementById('personalia_hair').value;
    segments.skin = document.getElementById('personalia_skin').value;
    segments.race = document.getElementById('personalia_race').value;
    segments.alignment = document.getElementById('personalia_alignment').value;
    segments.deity = document.getElementById('personalia_deity').value;
    segments.xp = document.getElementById('personalia_xp').value;
    segments.next_level = document.getElementById('personalia_next_level').value;

    var jsonString = JSON.stringify(segments);
    
    callback(jsonString);
}

/**
 * A function to write all of the stats fields' values to the database.
 */
function updateStats() {
    getStatsSegments(function(segments) {
        runQuery("update_stats=", segments);
    });
}

/**
* A function to get the stats fields' values, in JSON-format (variable:value)
* @param callback
*/
function getStatsSegments(callback) {
    var segments = new Object();

    segments.stats_hp = document.getElementById('stats_hp').value;
    segments.stats_wounds = document.getElementById('stats_wounds').value;
    segments.stats_non_lethal = document.getElementById('stats_non_lethal').value;
    segments.stats_initiative_mod = document.getElementById('stats_initiative_mod').value;
    segments.stats_spell_resistance = document.getElementById('stats_spell_resistance').value;
    segments.stats_speed = document.getElementById('stats_speed').value;
    segments.stats_damage_reduction = document.getElementById('stats_damage_reduction').value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the armor class fields' values to the database.
 */
function updateArmorClass() {
    getArmorClassSegments(function(segments) {
        runQuery("update_armor_class=", segments);
    });
}

/**
 * A function to get the armor class fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getArmorClassSegments(callback) {
    var segments = new Object();

    segments.ac_total = document.getElementById('armor_class_total').value;
    segments.ac_base = document.getElementById('armor_class_base').value;
    segments.ac_armor_bonus = document.getElementById('armor_class_armor_bonus').value;
    segments.ac_shield_bonus = document.getElementById('armor_class_shield_bonus').value;
    segments.ac_dex_mod = document.getElementById('armor_class_dex_mod').value;
    segments.ac_size_mod = document.getElementById('armor_class_size_mod').value;
    segments.ac_natural_armor = document.getElementById('armor_class_natural_armor').value;
    segments.ac_touch_ac = document.getElementById('armor_class_touch_ac').value;
    segments.ac_flat_footed_ac = document.getElementById('armor_class_flat_footed_ac').value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the attribute's fields' values to the database.
 */
function updateAttribute() {
    var label = this.parentNode.parentNode.childNodes[1].innerHTML;
    getAttributeSegments(label, function(segments) {
        runQuery("update_attribute=", segments);
    });
}

/**
 * A function to get the current attribute's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttributeSegments(label, callback) {
    var segments = new Object();
    var name = label.toLowerCase();
    var ability_score = name.concat('_ability_score');
    var ability_mod = name.concat('_ability_mod');
    var temp_score = name.concat('_temp_score');
    var temp_mod = name.concat('_temp_mod');

    segments.name = name;
    segments.ability_score = document.getElementById(ability_score).value;
    segments.ability_mod = document.getElementById(ability_mod).value;
    segments.temp_score = document.getElementById(temp_score).value;
    segments.temp_mod = document.getElementById(temp_mod).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the current saving throw's fields' values to the database.
 */
function updateSavingThrow() {
    var label = this.parentNode.parentNode.childNodes[1].innerHTML;
    getSavingThrowSegments(label, function(segments) {
        runQuery("update_saving_throw=", segments, false);
    });
}

/**
 * A function to get the saving throw's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSavingThrowSegments(label, callback) {
    var segments = new Object();
    var name = label.toLowerCase();
    var total = name.concat('_total');
    var base_save = name.concat('_base_save');
    var ability_mod = name.concat('_ability_mod');
    var magic_mod = name.concat('_magic_mod');
    var misc_mod = name.concat('_misc_mod');
    var temp_mod = name.concat('_temp_mod');

    segments.name = name;
    segments.total = document.getElementById(total).value;
    segments.base_save = document.getElementById(base_save).value;
    segments.ability_mod = document.getElementById(ability_mod).value;
    segments.magic_mod= document.getElementById(magic_mod).value;
    segments.misc_mod= document.getElementById(misc_mod).value;
    segments.temp_mod = document.getElementById(temp_mod).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the attacks' fields' values to the database.
 */
function updateAttacks() {
    getAttacksSegments(function(segments) {
        runQuery("update_attacks=", segments);
    });
}

/**
 * A function to get the current attacks' fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttacksSegments(callback) {
    var segments = new Object();

    segments.base_attack_bonus = document.getElementById('base_attack_bonus').value;
    segments.attacks_per_round = document.getElementById('number_of_attacks').value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the attack's fields' values to the database.
 */
function updateAttack() {
    var element = this.parentNode;
    getAttackSegments(element, function(segments) {
        runQuery("update_attack=", segments);
    });
}

/**
 * A function to get the current attack's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttackSegments(element, callback) {
    var segments = new Object();
    var nodes = element.childNodes;

    var id = nodes[1].value;
    var name = nodes[4].value;
    var base_attack_bonus = nodes[7].value;
    var attack_damage = nodes[10].value;
    var attack_critical_floor = nodes[13].value;
    var attack_critical_ceiling = nodes[15].value;
    var attack_range = nodes[18].value;
    var attack_type = nodes[21].value;
    var attack_notes = nodes[24].value;
    var attack_ammunition = nodes[27].value;

    segments.id = id;
    segments.attack_name = name;
    segments.attack_bonus = base_attack_bonus;
    segments.attack_damage = attack_damage;
    segments.critical_floor = attack_critical_floor;
    segments.critical_ceiling = attack_critical_ceiling;
    segments.weapon_range = attack_range;
    segments.attack_type = attack_type;
    segments.attack_notes = attack_notes;
    segments.ammunition = attack_ammunition;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the grapple's fields' values to the database.
 */
function updateGrapple() {
    getGrappleSegments(function(segments) {
        runQuery("update_grapple=", segments);
    });
}

/**
 * A function to get the grapple fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getGrappleSegments(callback) {
    var segments = new Object();

    var label = 'grapple';
    var total = label.concat('_total');
    var bab = label.concat('_bab');
    var str_mod = label.concat('_str_mod');
    var size_mod = label.concat('_size_mod');
    var misc_mod = label.concat('_misc_mod');

    segments.grapple_total = document.getElementById(total).value;
    segments.grapple_bab = document.getElementById(bab).value;
    segments.grapple_str_mod = document.getElementById(str_mod).value;
    segments.grapple_size_mod = document.getElementById(size_mod).value;
    segments.grapple_misc_mod = document.getElementById(misc_mod).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the armor's fields' values to the database.
 */
function updateArmor() {
    getArmorSegments(function(segments) {
        runQuery("update_armor=", segments);
    });
}

/**
 * A function to get the armor fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getArmorSegments(callback) {
    var segments = new Object();

    var label = 'armor';

    segments.armor_name = document.getElementById(label.concat('_name')).value;
    segments.armor_type = document.getElementById(label.concat('_type')).value;
    segments.armor_ac_bonus = document.getElementById(label.concat('_ac_bonus')).value;
    segments.armor_max_dex = document.getElementById(label.concat('_max_dex')).value;
    segments.armor_check_penalty = document.getElementById(label.concat('_check_penalty')).value;
    segments.armor_spell_failure = document.getElementById(label.concat('_spell_failure')).value;
    segments.armor_speed = document.getElementById(label.concat('_speed')).value;
    segments.armor_weight = document.getElementById(label.concat('_weight')).value;
    segments.armor_special_properties = document.getElementById(label.concat('_special_properties')).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the shields' fields' values to the database.
 */
function updateShield() {
    getShieldSegments(function(segments) {
        runQuery("update_shield=", segments);
    });
}

/**
 * A function to get the shield fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getShieldSegments(callback) {
    var segments = new Object();

    var label = 'shield_';

    segments.shield_name = document.getElementById(label.concat('name')).value;
    segments.shield_ac_bonus = document.getElementById(label.concat('ac_bonus')).value;
    segments.shield_check_penalty = document.getElementById(label.concat('check_penalty')).value;
    segments.shield_spell_failure = document.getElementById(label.concat('spell_failure')).value;
    segments.shield_weight = document.getElementById(label.concat('weight')).value;
    segments.shield_special_properties = document.getElementById(label.concat('special_properties')).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the protective item's fields' values to the database.
 */
function updateProtectiveItem() {
    var element = this.parentNode;
    getProtectiveItemSegments(element, function(segments) {
        runQuery("update_protective_item=", segments);
    });
}

/**
 * A function to get the protective item fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getProtectiveItemSegments(element, callback) {
    var segments = new Object();
    var nodes = element.childNodes;

    segments.protective_item_id = nodes[1].value;
    segments.protective_item_name = nodes[4].value;
    segments.protective_item_ac_bonus = nodes[7].value;
    segments.protective_item_weight = nodes[10].value;
    segments.protective_item_special_properties = nodes[13].value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the skills' fields' values to the database.
 */
function updateSkills() {
    getSkillsSegments(function(segments) {
        runQuery("update_skills=", segments);
    });
}

/**
 * A function to get the skills fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSkillsSegments(callback) {
    var segments = new Object();

    var label = 'skills_';

    segments.max_ranks_class = document.getElementById(label.concat('max_ranks_class')).value;
    segments.max_ranks_cross_class = document.getElementById(label.concat('max_ranks_cross_class')).value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the skill's fields' values to the database.
 */
function updateSkill() {
    var skill_element = element.parentNode.parentNode;
    getSkillSegments(skill_element, function(segments) {
        runQuery("update_skill=", segments);
    });
}

/**
 * A function to get the current skill fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSkillSegments(element, callback) {
    var segments = new Object();

    segments.template_name = element.childNodes[1].childNodes[1].value;
    segments.skill_mod = element.childNodes[5].childNodes[0].value;
    segments.ability_mod = element.childNodes[7].childNodes[0].value;
    segments.ranks = element.childNodes[9].childNodes[0].value;
    segments.misc_mod = element.childNodes[11].childNodes[0].value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the language's fields' values to the database.
 */
function updateLanguages() {
    getLanguagesSegments(function(segments) {
        runQuery("update_languages=", segments);
    });
}

/**
 * A function to get the current languages fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getLanguagesSegments(callback) {
    var segments = new Object();
    segments.max_number_of_languages = document.getElementById('max_number_of_languages').value;
    var jsonString = JSON.stringify(segments);
    callback(jsonString);
}

/**
 * A function to write all of the item's fields' values to the database.
 */
function updateItem() {
    var item_element = this.parentNode.parentNode;
    getItemSegments(item_element, function(segments) {
        runQuery("update_item=", segments);
    });
}

/**
 * A function to get the current item's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getItemSegments(element, callback) {
    var segments = new Object();

    segments.item_id = element.childNodes[1].childNodes[0].value;
    segments.item_name = element.childNodes[1].childNodes[1].value;
    segments.item_quantity = element.childNodes[3].childNodes[0].value;
    segments.item_weight = element.childNodes[5].childNodes[0].value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the inventory's fields' values to the database.
 */
function updateInventory() {
    getInventorySegments(function(segments) {
        runQuery("update_inventory=", segments);
    });
}

/**
 * A function to get the inventory's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getInventorySegments(callback) {
    var segments = new Object();

    segments.light_load = document.getElementById('inventory_light_load').value;
    segments.medium_load = document.getElementById('inventory_medium_load').value;
    segments.heavy_load = document.getElementById('inventory_heavy_load').value;
    segments.lift_over_head = document.getElementById('inventory_lift_over_head').value;
    segments.lift_off_ground = document.getElementById('inventory_lift_off_ground').value;
    segments.push_or_drag = document.getElementById('inventory_push_or_drag').value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to write all of the currency's fields' values to the database.
 */
function updateCurrency() {
    var currency_element = this.parentNode.parentNode;
    getCurrencySegments(currency_element, function(segments) {
        var action = "update_currency=";
            runQuery(action, segments);
    });
}

/**
 * A function to get the current currency's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getCurrencySegments(element, callback) {
    var segments = new Object();

    segments.label = element.childNodes[1].innerHTML;
    segments.name = element.childNodes[3].childNodes[0].name;
    segments.amount = element.childNodes[3].childNodes[0].value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

/**
 * A function to send an action to the character-sheet.php through POST, where the action will be picked up and
 * routed accordingly with the segments parameter.
 * @param post_action the action to send with the POST request
 * @param segments the values to be added to the database via the POST action
 * @param json boolean value which stats whether the return value should be parsed as JSON
 * @param callback optional callback function
 */
function runQuery(post_action, segments, json, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            if(callback) {
                if(json) {
                    var return_value = JSON.parse(result);
                    callback(return_value);
                } else {
                    callback(result);
                }
            } else {
                callback();
            }
        }
    }

    var params = post_action.concat(segments);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * A function to add eventlisteners to the stated elements
 * @param ix_array array - an array of arrays of which to add eventlisteners
 */
function addListeners(ix_array) {
    //for each array in array
    for(var i = 0; i < ix_array.length; i++) {
        var elements = ix_array[i][0];

        //check if elements is an array
        //if not; make elements a new array and push single object
        if(!elements.length > 0) {
            elements = new Array();
            elements.push(ix_array[i][0]);
        }

        //for each array in elements
        for(var x = 0; x < elements.length; x++) {
            elements[x].addEventListener(ix_array[i][1], ix_array[i][2], false);
        }

    }
}

/**
 * a function to initialize functions on window load
 */
function init() {
    var ix_elements = [
        [document.getElementsByClassName('inventory_input'), 'blur', updateInventory],
        [document.getElementsByClassName('item_input'), 'blur', updateItem],
        [document.getElementsByClassName('currency_input'), 'blur', updateCurrency],
        [document.getElementsByClassName('languages_input'), 'blur', updateLanguages],
        [document.getElementsByClassName('skill_input'), 'blur', updateSkill],
        [document.getElementsByClassName('skills_input'), 'blur', updateSkills],
        [document.getElementsByClassName('protective_item_input'), 'blur', updateProtectiveItem],
        [document.getElementsByClassName('shield_input'), 'blur', updateShield],
        [document.getElementsByClassName('armor_input'), 'blur', updateArmor],
        [document.getElementsByClassName('grapple_input'), 'blur', updateGrapple],
        [document.getElementsByClassName('attack_input'), 'blur', updateAttack],
        [document.getElementsByClassName('attacks_input'), 'blur', updateAttacks],
        [document.getElementsByClassName('saving_throw_input'), 'blur', updateSavingThrow],
        [document.getElementsByClassName('attribute_input'), 'blur', updateAttribute],
        [document.getElementsByClassName('armor_class_input'), 'blur', updateArmorClass],
        [document.getElementsByClassName('stats_input'), 'blur', updateStats],
        [document.getElementsByClassName('personalia_input'), 'blur', updatePersonalia],
        [document.getElementById('feats_search_input'), 'input', findFeatsSuggestions],
        [document.getElementById('special_ability_search_input'), 'input', findSpecialAbilitySuggestions],
        [document.getElementsByClassName('feat_template_info'), 'click', showFeatInfo],
        [document.getElementsByClassName('special_ability_template_info'), 'click', showSpecialAbilityInfo],
        [document.getElementsByClassName('skill_template_info'), 'click', showSkillInfo],
        [document.getElementsByClassName('remove_special_ability'), 'click', removeSpecialAbility],
        [document.getElementsByClassName('remove_feat'), 'click', removeFeat],
        [document.getElementsByClassName('remove_item'), 'click', removeItem],
        [document.getElementsByClassName('remove_attack'), 'click', removeAttack],
        [document.getElementsByClassName('remove_protective_item'), 'click', removeProtectiveItem],
        [document.getElementsByClassName('remove_currency'), 'click', removeCurrency],
        [document.getElementsByClassName('remove_language'), 'click', removeLanguage]
    ];

    addListeners(ix_elements);
}

/**
 * load init functions on window load
 */
window.onload = function() {
    init();
}
