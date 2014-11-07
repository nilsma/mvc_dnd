//GLOBAL VARIABLES
var special_ability_template_name;
var feat_template_name;
var spell_template_name;

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
 * A function to remove a given protective item from the database.
 * The function gets the protective item's SQL id from the HTML and removes the protective item from
 * the database by sending the id with the POST action to the governing PHP-file
 * through the runQuery function.
 * Finally reloads the page to update the character sheet
 */
function removeProtectiveItem() {
    if(confirmChoice('remove protective item')) {
        var data = new Object();
        data.protective_item_id = this.parentNode.parentNode.childNodes[1].value;
        runQuery("remove", "protective_item", JSON.stringify(data), false, true, function() {
            location.reload();
        });
    }
}

/**
 * A function to remove a given item from the database.
 * The function gets the item's SQL id from the HTML and removes the item from the database by sending
 * the id with the POST action to the governing PHP-file through the runQuery function
 */
function removeItem() {
    if(confirmChoice('remove item')) {
        var data = new Object();
        data.item_id = this.parentNode.parentNode.childNodes[1].childNodes[0].value;
        runQuery("remove", "item", JSON.stringify(data), false, false, function() {
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
    if(confirmChoice('remove attack')) {
        var data = new Object();
        data.attack_id = this.parentNode.parentNode.childNodes[1].value;
        runQuery("remove", "attack", JSON.stringify(data), false, false, function() {
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
    if(confirmChoice('remove feat')) {
        var data = new Object();
        data.template_name = this.parentNode.id;
        runQuery("remove", "feat", JSON.stringify(data), false, false, function() {
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
function removeSpell() {
    if(confirmChoice('remove spell')) {
        var data = new Object();
        data.template_name = this.parentNode.parentNode.childNodes[1].id;
        runQuery("remove", "spell", JSON.stringify(data), false, false, function() {
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
    if(confirmChoice('remove special ability')) {
        var data = new Object();
        data.template_name = this.parentNode.id;
        runQuery("remove", "special_ability", JSON.stringify(data), false, false, function() {
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
    if(confirmChoice('remove language')) {
        var data = new Object();
        data.language = this.parentNode.childNodes[0].innerHTML;
        runQuery("remove", "language", JSON.stringify(data), false, false, function() {
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
    if(confirmChoice('remove currency')) {
        var data = new Object();
        data.currency = this.parentNode.parentNode.childNodes[1].innerHTML;
        runQuery("remove", "currency", JSON.stringify(data), false, false, function() {
            location.reload();
        });
    }
}

/**
 * A function to find temlates suggestions for the user
 * as the user adds text to search input field
 */
function findSuggestions() {
    var template_type = this.parentNode.id;
    var element = document.getElementById(template_type.concat('_box'));
    var data = new Object();
    data.input = this.value;
    runQuery("select", template_type, JSON.stringify(data), true, true, function(suggestions){
        addHTMLtoElement(element, suggestions);
    });
}

/**
 * A function to get a special ability's description and add it to the special ability description div.
 */
function showSpecialAbilityDescription() {
    var element = document.getElementById('special_ability_template_description');
    var data = new Object();
    data.template_name = this.parentNode.id;
    runQuery("select", "special_ability_description", JSON.stringify(data), false, true, function(description) {
        addHTMLtoElement(element, description);
    });
}

/**
 * A function to get a feat's description and add it to the feat description div.
 */
function showFeatDescription() {
    var data = new Object();
    data.template_name = this.parentNode.id;
    var element = document.getElementById('feat_template_description');
    runQuery("select", "feat_description", JSON.stringify(data), false, true, function(description) {
        addHTMLtoElement(element, description);
    });
}

/**
 * A function to get a skill's description and add it to the skill description div.
 */
function showSkillDescription() {
    var element = document.getElementById('skill_template_description');
    var data = new Object();
    data.template_name = this.parentNode.parentNode.childNodes[1].value;
    runQuery("select", "skill_description", JSON.stringify(data), false, true, function(description) {
        addHTMLtoElement(element, description);
    });
}

/**
 * A function to get a feat's description and add it to the feat description div.
 */
function showSpellDescription() {
    var data = new Object();
    data.template_name = this.parentNode.id;
    var element = document.getElementById('spell_template_description');
    runQuery("select", "spell_description", JSON.stringify(data), false, true, function(description) {
        addHTMLtoElement(element, description);
    });
}


function closeSkillDescription() {
    var el = document.getElementById('skill_template_description');
    el.innerHTML='';
}

function closeSpecialAbilityDescription() {
    var el = document.getElementById('special_ability_template_description');
    el.innerHTML='';
}

function closeFeatDescription() {
    var el = document.getElementById('feat_template_description');
    el.innerHTML='';
}

function closeSpellDescription() {
    var el = document.getElementById('spell_template_description');
    el.innerHTML='';
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

function chooseSpellTemplate(template_name, base_class, common_name) {
    var displayed_node = document.getElementById('spell_search_input');
    var template_node = document.getElementById('spell_search_template');
    var base_class_node = document.getElementById('spell_search_base_class');
    setSpellSuggestionToInput(template_name, common_name, base_class, displayed_node, template_node, base_class_node, function() {
        var emptyArray = new Array();
        addResultToSpellSuggestionsBox(emptyArray);
    });
}

function setSpellSuggestionToInput(template_name, common_name, base_class, displayed_node, template_node, base_class_node, callback) {
    displayed_node.value=common_name;
    template_node.value=template_name;
    base_class_node.value=base_class;
    spell_template_name = template_name;
    callback();
}

/**
 * A function to write all of the personalia fields' values to the database.
 */
function updatePersonalia() {
    getPersonaliaData(function(data) {
        runQuery("update", "personalia", data, false, true);
    });
}

/**
 * A function to get the personalia fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getPersonaliaData(callback) {
    var data = new Object();
    data.name = name = document.getElementById('personalia_name').value;
    data.class = document.getElementById('personalia_class').value;
    data.level = document.getElementById('personalia_level').value;
    data.size = document.getElementById('personalia_size').value;
    data.age = document.getElementById('personalia_age').value;
    data.gender = document.getElementById('personalia_gender').value;
    data.height = document.getElementById('personalia_height').value;
    data.weight = document.getElementById('personalia_weight').value;
    data.eyes = document.getElementById('personalia_eyes').value;
    data.hair = document.getElementById('personalia_hair').value;
    data.skin = document.getElementById('personalia_skin').value;
    data.race = document.getElementById('personalia_race').value;
    data.alignment = document.getElementById('personalia_alignment').value;
    data.deity = document.getElementById('personalia_deity').value;
    data.xp = document.getElementById('personalia_xp').value;
    data.next_level = document.getElementById('personalia_next_level').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the stats fields' values to the database.
 */
function updateStats() {
    getStatsData(function(data) {
        runQuery("update", "stats", data, false, true);
    });
}

/**
* A function to get the stats fields' values, in JSON-format (variable:value)
* @param callback
*/
function getStatsData(callback) {
    var data = new Object();
    data.stats_hp = document.getElementById('stats_hp').value;
    data.stats_wounds = document.getElementById('stats_wounds').value;
    data.stats_non_lethal = document.getElementById('stats_non_lethal').value;
    data.stats_initiative_mod = document.getElementById('stats_initiative_mod').value;
    data.stats_spell_resistance = document.getElementById('stats_spell_resistance').value;
    data.stats_speed = document.getElementById('stats_speed').value;
    data.stats_damage_reduction = document.getElementById('stats_damage_reduction').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the armor class fields' values to the database.
 */
function updateArmorClass() {
    getArmorClassData(function(data) {
        runQuery("update", "armor_class", data, false, true);
    });
}

/**
 * A function to get the armor class fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getArmorClassData(callback) {
    var data = new Object();
    data.ac_total = document.getElementById('armor_class_total').value;
    data.ac_base = document.getElementById('armor_class_base').value;
    data.ac_armor_bonus = document.getElementById('armor_class_armor_bonus').value;
    data.ac_shield_bonus = document.getElementById('armor_class_shield_bonus').value;
    data.ac_dex_mod = document.getElementById('armor_class_dex_mod').value;
    data.ac_size_mod = document.getElementById('armor_class_size_mod').value;
    data.ac_natural_armor = document.getElementById('armor_class_natural_armor').value;
    data.ac_touch_ac = document.getElementById('armor_class_touch_ac').value;
    data.ac_flat_footed_ac = document.getElementById('armor_class_flat_footed_ac').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the attribute's fields' values to the database.
 */
function updateAttribute() {
    var label = this.parentNode.parentNode.childNodes[1].innerHTML;
    getAttributeData(label, function(data) {
        runQuery("update", "attribute", data, false, true);
    });
}

/**
 * A function to get the current attribute's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttributeData(label, callback) {
    var data = new Object();
    var name = label.toLowerCase();
    var ability_score = name.concat('_ability_score');
    var ability_mod = name.concat('_ability_mod');
    var temp_score = name.concat('_temp_score');
    var temp_mod = name.concat('_temp_mod');

    data.name = name;
    data.ability_score = document.getElementById(ability_score).value;
    data.ability_mod = document.getElementById(ability_mod).value;
    data.temp_score = document.getElementById(temp_score).value;
    data.temp_mod = document.getElementById(temp_mod).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the current saving throw's fields' values to the database.
 */
function updateSavingThrow() {
    var label = this.parentNode.parentNode.childNodes[1].innerHTML;
    getSavingThrowData(label, function(data) {
        runQuery("update", "saving_throw", data, false, true);
    });
}

/**
 * A function to get the saving throw's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSavingThrowData(label, callback) {
    var data = new Object();
    var name = label.toLowerCase();
    var total = name.concat('_total');
    var base_save = name.concat('_base_save');
    var ability_mod = name.concat('_ability_mod');
    var magic_mod = name.concat('_magic_mod');
    var misc_mod = name.concat('_misc_mod');
    var temp_mod = name.concat('_temp_mod');

    data.name = name;
    data.total = document.getElementById(total).value;
    data.base_save = document.getElementById(base_save).value;
    data.ability_mod = document.getElementById(ability_mod).value;
    data.magic_mod= document.getElementById(magic_mod).value;
    data.misc_mod= document.getElementById(misc_mod).value;
    data.temp_mod = document.getElementById(temp_mod).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the attacks' fields' values to the database.
 */
function updateAttacks() {
    getAttacksData(function(data) {
        runQuery("update", "attacks", data, false, true);
    });
}

/**
 * A function to get the current attacks' fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttacksData(callback) {
    var data = new Object();
    data.base_attack_bonus = document.getElementById('base_attack_bonus').value;
    data.attacks_per_round = document.getElementById('number_of_attacks').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the attack's fields' values to the database.
 */
function updateAttack() {
    var element = this.parentNode;
    getAttackData(element, function(data) {
        runQuery("update", "attack", data, false, true);
    });
}

/**
 * A function to get the current attack's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getAttackData(element, callback) {
    var data = new Object();
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

    data.id = id;
    data.attack_name = name;
    data.attack_bonus = base_attack_bonus;
    data.attack_damage = attack_damage;
    data.critical_floor = attack_critical_floor;
    data.critical_ceiling = attack_critical_ceiling;
    data.weapon_range = attack_range;
    data.attack_type = attack_type;
    data.attack_notes = attack_notes;
    data.ammunition = attack_ammunition;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the grapple's fields' values to the database.
 */
function updateGrapple() {
    getGrappleData(function(data) {
        runQuery("update", "grapple", data, false, true);
    });
}

/**
 * A function to get the grapple fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getGrappleData(callback) {
    var data = new Object();
    var label = 'grapple';
    var total = label.concat('_total');
    var bab = label.concat('_bab');
    var str_mod = label.concat('_str_mod');
    var size_mod = label.concat('_size_mod');
    var misc_mod = label.concat('_misc_mod');

    data.grapple_total = document.getElementById(total).value;
    data.grapple_bab = document.getElementById(bab).value;
    data.grapple_str_mod = document.getElementById(str_mod).value;
    data.grapple_size_mod = document.getElementById(size_mod).value;
    data.grapple_misc_mod = document.getElementById(misc_mod).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the armor's fields' values to the database.
 */
function updateArmor() {
    getArmorData(function(data) {
        runQuery("update", "armor", data, false, true);
    });
}

/**
 * A function to get the armor fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getArmorData(callback) {
    var data = new Object();
    var label = 'armor';

    data.armor_name = document.getElementById(label.concat('_name')).value;
    data.armor_type = document.getElementById(label.concat('_type')).value;
    data.armor_ac_bonus = document.getElementById(label.concat('_ac_bonus')).value;
    data.armor_max_dex = document.getElementById(label.concat('_max_dex')).value;
    data.armor_check_penalty = document.getElementById(label.concat('_check_penalty')).value;
    data.armor_spell_failure = document.getElementById(label.concat('_spell_failure')).value;
    data.armor_speed = document.getElementById(label.concat('_speed')).value;
    data.armor_weight = document.getElementById(label.concat('_weight')).value;
    data.armor_special_properties = document.getElementById(label.concat('_special_properties')).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the shields' fields' values to the database.
 */
function updateShield() {
    getShieldData(function(data) {
        runQuery("update", "shield", data, false, true);
    });
}

/**
 * A function to get the shield fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getShieldData(callback) {
    var data = new Object();
    var label = 'shield_';

    data.shield_name = document.getElementById(label.concat('name')).value;
    data.shield_ac_bonus = document.getElementById(label.concat('ac_bonus')).value;
    data.shield_check_penalty = document.getElementById(label.concat('check_penalty')).value;
    data.shield_spell_failure = document.getElementById(label.concat('spell_failure')).value;
    data.shield_weight = document.getElementById(label.concat('weight')).value;
    data.shield_special_properties = document.getElementById(label.concat('special_properties')).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the protective item's fields' values to the database.
 */
function updateProtectiveItem() {
    var element = this.parentNode;
    getProtectiveItemData(element, function(data) {
        runQuery("update", "protective_item", data, false, true);
    });
}

/**
 * A function to get the protective item fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getProtectiveItemData(element, callback) {
    var data = new Object();
    var nodes = element.childNodes;

    data.protective_item_id = nodes[1].value;
    data.protective_item_name = nodes[4].value;
    data.protective_item_ac_bonus = nodes[7].value;
    data.protective_item_weight = nodes[10].value;
    data.protective_item_special_properties = nodes[13].value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the skills' fields' values to the database.
 */
function updateSkills() {
    getSkillsData(function(data) {
        runQuery("update", "skills", data, false, true);
    });
}

/**
 * A function to get the skills fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSkillsData(callback) {
    var data = new Object();
    var label = 'skills_';

    data.max_ranks_class = document.getElementById(label.concat('max_ranks_class')).value;
    data.max_ranks_cross_class = document.getElementById(label.concat('max_ranks_cross_class')).value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the skill's fields' values to the database.
 */
function updateSkill() {
    var skill_element = this.parentNode.parentNode;
    getSkillData(skill_element, function(data) {
        runQuery("update", "skill", data, false, true);
    });
}

/**
 * A function to get the current skill fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getSkillData(element, callback) {
    var data = new Object();

    data.template_name = element.childNodes[1].childNodes[1].value;
    data.skill_mod = element.childNodes[5].childNodes[0].value;
    data.ability_mod = element.childNodes[7].childNodes[0].value;
    data.ranks = element.childNodes[9].childNodes[0].value;
    data.misc_mod = element.childNodes[11].childNodes[0].value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the language's fields' values to the database.
 */
function updateLanguages() {
    getLanguagesData(function(data) {
        runQuery("update", "languages", data, false, true);
    });
}

/**
 * A function to get the current languages fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getLanguagesData(callback) {
    var data = new Object();

    data.max_number_of_languages = document.getElementById('max_number_of_languages').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the item's fields' values to the database.
 */
function updateItem() {
    var item_element = this.parentNode.parentNode;
    getItemData(item_element, function(data) {
        runQuery("update", "item", data, false, true);
    });
}

/**
 * A function to get the current item's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getItemData(element, callback) {
    var data = new Object();

    data.item_id = element.childNodes[1].childNodes[0].value;
    data.item_name = element.childNodes[1].childNodes[1].value;
    data.item_quantity = element.childNodes[3].childNodes[0].value;
    data.item_weight = element.childNodes[5].childNodes[0].value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the inventory's fields' values to the database.
 */
function updateInventory() {
    var action = "update";
    var segment = "inventory";
    var json = false;
    var decode = true;
    getInventoryData(function(data) {
        runQuery("update", "inventory", data, false, true);
    });
}

/**
 * A function to get the inventory's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getInventoryData(callback) {
    var data = new Object();

    data.light_load = document.getElementById('inventory_light_load').value;
    data.medium_load = document.getElementById('inventory_medium_load').value;
    data.heavy_load = document.getElementById('inventory_heavy_load').value;
    data.lift_over_head = document.getElementById('inventory_lift_over_head').value;
    data.lift_off_ground = document.getElementById('inventory_lift_off_ground').value;
    data.push_or_drag = document.getElementById('inventory_push_or_drag').value;

    callback(JSON.stringify(data));
}

/**
 * A function to write all of the currency's fields' values to the database.
 */
function updateCurrency() {
    var currency_element = this.parentNode.parentNode;
    getCurrencyData(currency_element, function(data) {
        runQuery("update", "currency", data, false, true);
    });
}

/**
 * A function to get the current currency's fields' values, in JSON-format (variable:value)
 * @param callback
 */
function getCurrencyData(element, callback) {
    var data = new Object();

    data.label = element.childNodes[1].innerHTML;
    data.name = element.childNodes[3].childNodes[0].name;
    data.amount = element.childNodes[3].childNodes[0].value;

    callback(JSON.stringify(data));
}

/**
 * A function to set the selected segment in the spell search, ie. which class and level the search is for.
 */
function setSelected() {
    var data = new Object();
    data.selected = this.value;

    var segment = this.parentNode.name;
    runQuery("set", segment, JSON.stringify(data), false, true, function() {
        location.reload();
    });
}

/**
 * A function to send a query to the character sheet php controller where it will be appropriately based on the post_action variable
 * @param post_action - the action to be carried out
 * @param post_segment - the character sheet segment to update
 * @param post_data - the data for the query to be run
 * @param json - if the return value should be json parsed, parsed if true, unparsed otherwise
 * @param post_decode - if the query data should be json decoded by the character-sheet php controller or not
 * @param callback
 */
function runQuery(post_action, post_segment, post_data, json, post_decode, callback) {
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

    var url = "character-sheet.php";
    var action = "action=".concat(post_action);
    var segment = "&segment=".concat(post_segment);
    var data = "&data=".concat(post_data);
    var decode = "&decode=".concat(post_decode);
    var params = action.concat(segment).concat(data).concat(decode);
    xmlhttp.open("POST", url, true);
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
        [document.getElementsByTagName('option'), 'click', setSelected],
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
        [document.getElementById('feats_search_input'), 'input', findSuggestions],
        [document.getElementById('special_ability_search_input'), 'input', findSuggestions],
        [document.getElementById('spell_search_input'), 'input', findSuggestions],
        [document.getElementsByClassName('feat_template_description'), 'click', showFeatDescription],
        [document.getElementsByClassName('special_ability_template_info'), 'click', showSpecialAbilityDescription],
        [document.getElementsByClassName('spell_template_description'), 'click', showSpellDescription],
        [document.getElementsByClassName('skill_template_info'), 'click', showSkillDescription],
        [document.getElementsByClassName('remove_special_ability'), 'click', removeSpecialAbility],
        [document.getElementsByClassName('remove_feat'), 'click', removeFeat],
        [document.getElementsByClassName('remove_spell'), 'click', removeSpell],
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