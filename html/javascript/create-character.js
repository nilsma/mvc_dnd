var special_ability_template_name;
var feat_template_name;

function confirmChoice(str) {
    return confirm('Are you sure you want to '.concat(str).concat(' ?'));
}

function removeCurrency() {
    var currency = this.parentNode.parentNode.childNodes[1].childNodes[0].innerText;
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
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function removeLanguage() {
    var language = this.parentNode.childNodes[0].innerText;
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
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
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
 * a function to add the suggestions to the feat suggestions box in the DOM
 * @param suggestions - an array of suggestions
 */
function addResultToFeatSuggestionsBox(suggestions) {
    var suggestions_box = document.getElementById('feats_suggestions_box');
    suggestions_box.innerHTML = suggestions;
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
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to get the name from the DOM of the special ability to remove
 * @param node - the node of the remove anchor that has been clicked
 * @param callback - sends name of the node back to the calling function
 */
function getSpecialAbilityToRemove(node, callback) {
    var el = node.parentNode.parentNode.childNodes[0];
    callback(el.innerHTML);
}

function getFeatToRemove(node, callback) {
    var el = node.parentNode.parentNode.childNodes[0];
    callback(el.innerHTML);
}

/**
 * a function to get the name of a special ability to add from the DOM
 * @param node - the node that has been clicked, ie the 'Add'-anchor
 * @param callback
 */
function getSpecialAbilityToAdd(node, callback) {
    var el = node.parentNode.childNodes[3];
    callback(el.value);
}

/**
 * a function to unload a given special ability from the special abilities array
 * based on the special ability's common name as referenced in the database
 * @param common_name - the name of the special ability to remove
 * @param callback
 */
function unloadSpecialAbility(common_name, callback) {
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

    var params = "unload_special_ability=".concat(common_name);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function unloadFeat(common_name, callback) {
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

    var params = "unload_feat=".concat(common_name);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to load a given special ability to the special abilities array
 * based on the special ability's common name as referenced in the database
 * @param common_name - the name of the special ability to add
 * @param callback
 */
function loadSpecialAbility(common_name, callback) {
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

    var params = "load_special_ability=".concat(common_name);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

function loadFeat(common_name, callback) {
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

    var params = "load_feat=".concat(common_name);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

/**
 * a function to remove a special ability from the character creation
 */
function removeSpecialAbility() {
    getSpecialAbilityToRemove(this, function(result) {
        unloadSpecialAbility(result, function() {
            location.reload();
        });
    });
}

function removeFeat() {
    getFeatToRemove(this, function(result) {
        unloadFeat(result, function() {
            location.reload();
        });
    });
}

/**
 * a function to add a special ability to the character creation
 */
function addSpecialAbility() {
    if(special_ability_template_name.length > 0) {
        loadSpecialAbility(special_ability_template_name, function() {
            special_ability_template_name = '';
            location.reload();
        });
    }
}

function addFeat() {
    if(feat_template_name.length > 0) {
        loadFeat(feat_template_name, function() {
            feat_template_name = '';
            location.reload();
        });
    }
}

/**
 * a function to get the special ability name from the Info-link
 * @param node - the corresponding node to the Info-link that has been clicked
 * @param callback
 */
function getSpecialAbilityName(node, callback) {
    var result = node.parentNode.parentNode.childNodes[0].innerHTML;
    callback(result);
}

function getFeatName(node, callback) {
    var result = node.parentNode.parentNode.childNodes[0].innerHTML;
    callback(result);
}

/**
 * a function to get the template's description based on its common_name
 * @param common_name - the common_name of the template to get the description of
 * @param callback
 */
function getSpecialAbilityInfo(common_name, callback) {
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

    var params = "special_ability_info=".concat(common_name);
    xmlhttp.open("POST", "create-character.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
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
    xmlhttp.open("POST", "create-character.php", true);
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

function addResultToFeatInfoBox(description) {
    var el = document.getElementById('feat_template_info');
    el.innerHTML=description;
}

/**
 * a function to get the special ability name from the database and subsequently
 * get that special ability's description from the database as a string representation
 * of html and set that info to the special ability info box
 */
function showSpecialAbilityInfo() {
    getSpecialAbilityName(this, function(common_name) {
        getSpecialAbilityInfo(common_name, function(info) {
            addResultToSpecialAbilityInfoBox(info);
        });
    });
}

function showFeatInfo() {
    getFeatName(this, function(common_name) {
        getFeatInfo(common_name, function(info) {
            addResultToFeatInfoBox(info);
        });
    });
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

function chooseFeatTemplate(template_name, common_name) {
    var displayed_node = document.getElementById('feats_search_input');
    var hidden_node = document.getElementById('feats_search_template');
    setFeatSuggestionToInput(template_name, common_name, displayed_node, hidden_node, function() {
        var emptyArray = new Array();
        addResultToFeatSuggestionsBox(emptyArray);
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

function setFeatSuggestionToInput(template_name, common_name, displayed_node, hidden_node, callback) {
    displayed_node.value=common_name;
    hidden_node.value=template_name;
    feat_template_name = template_name;
    callback();
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
    var els = document.getElementsByClassName('remove_currency');
    addListeners(els, 'click', removeCurrency);

    var els = new Array();
    var els = document.getElementsByClassName('remove_language');
    addListeners(els, 'click', removeLanguage);

    var els = new Array();
    var el = document.getElementById('special_ability_search_input');
    els.push(el);
    addListeners(els, 'input', findSpecialAbilitySuggestions);

    var els = new Array();
    var el = document.getElementById('feats_search_input');
    els.push(el);
    addListeners(els, 'input', findFeatsSuggestions);

    var els = new Array();
    var els = document.getElementsByClassName('remove_special_ability');
    addListeners(els, 'click', removeSpecialAbility);

    var els = new Array();
    var els = document.getElementsByClassName('remove_feat');
    addListeners(els, 'click', removeFeat);

    var els = new Array();
    var els = document.getElementsByClassName('special_ability_template_info')
    addListeners(els, 'click', showSpecialAbilityInfo);

    var els = new Array();
    var els = document.getElementsByClassName('feat_template_info')
    addListeners(els, 'click', showFeatInfo);
}

/**
 * load init functions on window load
 */
window.onload = function() {
    init();
}