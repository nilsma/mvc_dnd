var special_ability_template_name;
var feat_template_name;

function confirmChoice(str) {
    return confirm('Are you sure you want to '.concat(str).concat(' ?'));
}

function removeItem() {
    var item = this.parentNode.parentNode.childNodes[1].childNodes[0].value;
    if(confirmChoice('remove item')) {
        removeItemQuery(item, function() {
            location.reload();
        });
    }
}

function removeItemQuery(item, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_item=".concat(item);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function removeCurrency() {
    var currency = this.parentNode.parentNode.childNodes[1].innerHTML;
    if(confirmChoice('remove currency')) {
        removeCurrencyQuery(currency, function() {
            location.reload();
        });
    }
}

function removeCurrencyQuery(currency, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_currency=".concat(currency);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function removeLanguage() {
    var language = this.parentNode.childNodes[0].innerHTML;
    if(confirmChoice('remove language')) {
        removeLanguageQuery(language, function() {
            location.reload();
        });
    }
}

function removeLanguageQuery(language, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_language=".concat(language);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to get the special ability name from the database and subsequently
 * get that special ability's description from the database as a string representation
 * of html and set that info to the special ability info box
 */
function showSpecialAbilityInfo() {
    getSpecialAbilityName(this, function(template_name) {
        getSpecialAbilityInfo(template_name, function(info) {
            addResultToSpecialAbilityInfoBox(info);
        });
    });
}

/**
 * a function to get the special ability name from the Info-link
 * @param node - the corresponding node to the Info-link that has been clicked
 * @param callback
 */
function getSpecialAbilityName(node, callback) {
    var result = node.parentNode.childNodes[0].id;
    callback(result);
}

/**
 * a function to get the template's description based on its common_name
 * @param template_name - the common_name of the template to get the description of
 * @param callback
 */
function getSpecialAbilityInfo(template_name, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback(result);
        }
    }

    var params = "special_ability_info=".concat(template_name);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to add a string representation of HTML to the special abillity template info box
 * @param description
 */
function addResultToSpecialAbilityInfoBox(description) {
    var el = document.getElementById('special_ability_template_info');
    el.innerHTML=description;
}

function showFeatInfo() {
    getFeatName(this, function(common_name) {
        getFeatInfo(common_name, function(info) {
            addResultToFeatInfoBox(info);
        });
    });
}

function getFeatName(node, callback) {
    var result = node.parentNode.childNodes[0].id;
    callback(result);
}

function getFeatInfo(common_name, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback(result);
        }
    }

    var params = "feat_info=".concat(common_name);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function closeSpecialAbilityInfo() {
    var el = document.getElementById('special_ability_template_info');
    el.innerHTML='';
}

function closeFeatInfo() {
    var el = document.getElementById('feat_template_info');
    el.innerHTML='';
}

function addResultToFeatInfoBox(description) {
    var el = document.getElementById('feat_template_info');
    el.innerHTML=description;
}

/**
 * A function to find special ability temlates suggestions for the user
 * when the user is adding special abilities
 */
function findSpecialAbilitySuggestions() {
    var input = this.value;

    findSpecialAbilityTemplatesQuery(input, function(suggestions) {
        addResultToSpecialAbilitySuggestionsBox(suggestions);
    });
}

/**
 * a function that queries the database through the special-ability-suggestions.php
 * for the special ability templates to suggest to the user - queries the database for
 * special ability templates which has common_name that starts with the string argument
 * @param str - what the special ability template should start with
 * @param callback - sends the results back to the calling function as a JSON object
 */
function findSpecialAbilityTemplatesQuery(str, callback) {
    var result;
    var suggestions;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            suggestions = JSON.parse(result);
            callback(suggestions);
        }
    }

    var params = "get_special_abilities_suggestions=".concat(str);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to add the suggestions to the special ability suggestions box in the DOM
 * @param suggestions - an array of suggestions
 */
function addResultToSpecialAbilitySuggestionsBox(suggestions) {
    var suggestions_box = document.getElementById('special_abilities_suggestions_box');
    suggestions_box.innerHTML = suggestions;
}

/**
 * a function to find the feat templates suggestions and add them to the HTML
 * feat suggestions box
 */
function findFeatsSuggestions() {
    var input = this.value;

    findFeatTemplatesQuery(input, function(suggestions) {
        addResultToFeatSuggestionsBox(suggestions);
    });
}

/**
 * a function to add the suggestions to the feat suggestions box in the DOM
 * @param suggestions - an array of suggestions
 */
function addResultToFeatSuggestionsBox(suggestions) {
    var suggestions_box = document.getElementById('feats_suggestions_box');
    suggestions_box.innerHTML = suggestions;
}

/**
 * a function that queries the database on feat common_name for feat templates to suggest to the user
 * based on the given input from the user
 * @param str - what the feat template's common_name string should contain
 * * @param callback - sends the results back to the calling function as a JSON objects
 */
function findFeatTemplatesQuery(str, callback) {
    var result;
    var suggestions;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            suggestions = JSON.parse(result);
            callback(suggestions);
        }
    }

    var params = "get_feat_suggestions=".concat(str);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function that is called when clicking a special ability template name in the application,
 * sets the clicked template name to the sepcial ability search input field and adds an empty
 * array to the suggestions box, ie clears the list of suggestions
 * @param template_name - the template_name of the special ability
 * @param common_name - the common_name of the special ability
 */
function chooseTemplate(template_name, common_name) {
    var displayed_node = document.getElementById('special_ability_search_input');
    var hidden_node = document.getElementById('special_ability_search_template');
    setSuggestionToInput(template_name, common_name, displayed_node, hidden_node, function() {
        var emptyArray = new Array();
        addResultToSpecialAbilitySuggestionsBox(emptyArray);
    });
}

/**
 * adds a suggestion common_name to the search input field and sets the special_ability_template_name to
 * the template_name as referenced in the database
 * @param template_name - the template_name of the special ability
 * @param common_name - the common_name of the special ability
 * @param displayed_node - the node holding the special ability common_name in the search input
 * @param hidden_node -the node holding the special ability template_name in a hidden input field
 * @param callback
 */
function setSuggestionToInput(template_name, common_name, displayed_node, hidden_node, callback) {
    displayed_node.value=common_name;
    hidden_node.value=template_name;
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

function removeSpecialAbility() {
    if(confirmChoice('remove special ability')) {
        getSpecialAbilityToRemove(this, function(result) {
            deleteSpecialAbilityQuery(result, function() {
                location.reload();
            });
        });
    }
}

function removeFeat() {
    if(confirmChoice('remove feat')) {
        getFeatToRemove(this, function(result) {
            deleteFeatQuery(result, function() {
                location.reload();
            });
        });
    }
}

function deleteFeatQuery(template_name, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_feat=".concat(template_name);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function deleteSpecialAbilityQuery(template_name, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_special_ability=".concat(template_name);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function getFeatToRemove(el, callback) {
    var template_name = el.parentNode.childNodes[0].id;
    callback(template_name);
}

function getSpecialAbilityToRemove(el, callback) {
    var template_name = el.parentNode.childNodes[0].id;
    callback(template_name);
}

function removeProtectiveItem() {
    if(confirmChoice('remove protective item')) {
        var protective_item_id = this.parentNode.parentNode.childNodes[1].value;
        removeProtectiveItemQuery(protective_item_id, function() {
            location.reload();
        });
    }
}

function removeProtectiveItemQuery(protective_item_id, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_protective_item=".concat(protective_item_id);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function removeAttack() {
    if(confirmChoice('remove attack')) {
        var attack_id = this.parentNode.parentNode.childNodes[1].value;
        removeAttackQuery(attack_id, function() {
            location.reload();
        });
    }
}

function removeAttackQuery(attack_id, callback) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
            callback();
        }
    }

    var params = "remove_attack=".concat(attack_id);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updatePersonalia() {
    getPersonaliaSegments(function(result) {
        updatePersonaliaQuery(result);
    });
}

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

function updatePersonaliaQuery(segments) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var params = "update_personalia=".concat(segments);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updateStats() {
    getStatsSegments(function(result) {
        updateStatsQuery(result);
    });
}

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

function updateStatsQuery(segments) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var params = "update_stats=".concat(segments);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updateArmorClass() {
    getArmorClassSegments(function(result) {
        updateArmorClassQuery(result);
    });
}

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

function updateArmorClassQuery(segments) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var params = "update_armor_class=".concat(segments);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updateAttribute() {
    getAttributeLabel(this, function(label) {
        getAttributeSegments(label, function(segments) {
            updateAttributeQuery(segments, label);
        });
    });
}

function getAttributeLabel(element, callback) {
    var label = element.parentNode.parentNode.childNodes[1].innerHTML;
    callback(label);
}

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

function updateAttributeQuery(segments, label) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var param1 = "update_attribute=".concat(segments);
    var param2 = "&update_attribute_label=".concat(label);
    var params = param1.concat(param2);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updateSavingThrow() {
    getSavingThrowLabel(this, function(label) {
        getSavingThrowSegments(label, function(segments) {
            updateSavingThrowQuery(segments, label);
        });
    });
}

function getSavingThrowLabel(element, callback) {
    var label = element.parentNode.parentNode.childNodes[1].innerHTML;
    callback(label);
}

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

function updateSavingThrowQuery(segments, label) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var param1 = "update_saving_throw=".concat(segments);
    var param2 = "&update_saving_throw_label=".concat(label);
    var params = param1.concat(param2);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function updateAttacks() {
    getAttacksSegments(function(segments) {
        updateAttacksQuery(segments);
    });
}

function getAttacksSegments(callback) {
    var segments = new Object();

    segments.base_attack_bonus = document.getElementById('base_attack_bonus').value;
    segments.attacks_per_round = document.getElementById('number_of_attacks').value;

    var jsonString = JSON.stringify(segments);

    callback(jsonString);
}

function updateAttacksQuery(segments) {
    var result;

    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            result = xmlhttp.responseText;
        }
    }

    var params = "update_attacks=".concat(segments);
    xmlhttp.open("POST", "character-sheet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * A function to add eventlisteners to the stated elements
 * @param els array - an array of elements of which to add listeners to
 * @param fnc function - the function name of which to trigger when the element is clicked
 */
function addListeners(els, type, fnc) {
    for(var i = 0; i < els.length; i++) {
        els[i].addEventListener(type, fnc, false);
    }
}

/**
 * a function to initialize functions on load
 */
function init() {
    var els = new Array();
    els = document.getElementsByClassName('attacks_input');
    addListeners(els, 'blur', updateAttacks);

    var els = new Array();
    els = document.getElementsByClassName('saving_throw_input');
    addListeners(els, 'blur', updateSavingThrow);

    var els = new Array();
    els = document.getElementsByClassName('attribute_input');
    addListeners(els, 'blur', updateAttribute);

    var els = new Array();
    els = document.getElementsByClassName('armor_class_input');
    addListeners(els, 'blur', updateArmorClass);

    var els = new Array();
    els = document.getElementsByClassName('stats_input');
    addListeners(els, 'blur', updateStats);

    var els = new Array();
    els = document.getElementsByClassName('personalia_input');
    addListeners(els, 'blur', updatePersonalia);

    var els = new Array();
    els = document.getElementsByClassName('remove_special_ability');
    addListeners(els, 'click', removeSpecialAbility);

    var els = new Array();
    els = document.getElementsByClassName('remove_feat');
    addListeners(els, 'click', removeFeat);

    var els = new Array();
    els = document.getElementsByClassName('remove_item');
    addListeners(els, 'click', removeItem);

    var els = new Array();
    els = document.getElementsByClassName('remove_attack');
    addListeners(els, 'click', removeAttack);

    var els = new Array();
    els = document.getElementsByClassName('remove_protective_item');
    addListeners(els, 'click', removeProtectiveItem);

    var els = new Array();
    var el = document.getElementById('feats_search_input');
    els.push(el);
    addListeners(els, 'input', findFeatsSuggestions);

    var els = new Array();
    var el = document.getElementById('special_ability_search_input');
    els.push(el);
    addListeners(els, 'input', findSpecialAbilitySuggestions);

    var els = new Array();
    var els = document.getElementsByClassName('feat_template_info');
    addListeners(els, 'click', showFeatInfo);

    var els = new Array();
    var els = document.getElementsByClassName('special_ability_template_info')
    addListeners(els, 'click', showSpecialAbilityInfo);

    var els = new Array();
    var els = document.getElementsByClassName('remove_language');
    addListeners(els, 'click', removeLanguage);

    var els = new Array();
    var els = document.getElementsByClassName('remove_currency');
    addListeners(els, 'click', removeCurrency);
}

/**
 * load init functions on window load
 */
window.onload = function() {
    init();
}
