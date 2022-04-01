//Order the element in shop page
var list = document.querySelector('.listOrder');
var listElements = document.querySelectorAll('.listOrder li');
var page = document.location.search;
var getsValues = new Array();
var OS

function orderSearch(page) {
    var search = page.substr(1);
    //Gets the elements of the serach separately in an array
    //(ex: gets vaut : [controller=home], [action=home])
    var gets = search.split('&');
    var values = new Array();

    //Get the values and the name in an array 
    //(ex: si "element" égal : "controller=home", l'index [0] va valoir "controller" et l'index [1] va valoir "home")
    gets.forEach(element => {
        var tempGetsValues = element.split('=');

        values.push(tempGetsValues[0]);
        values.push(tempGetsValues[1]);
    });

    return values
}

getsValues = orderSearch(page);

var osOrConstruct;

function getTheOsOrConstructor(valuesOfGet) {
    
    //Get the value off the get "os" or of the get "constructor"
    for (let i = 0; i < valuesOfGet.length; i++) {
        if(valuesOfGet[i] == "os"){
            osOrConstruct = "os"
            return valuesOfGet[i + 1];
        }
        if(valuesOfGet[i] == "constructor"){
            osOrConstruct = "construct"
            return valuesOfGet[i + 1];
        }
    }
    return "";
}

OsOrConstructor = getTheOsOrConstructor(getsValues);

list.onchange = function () {
    var value = list.options[list.selectedIndex].value;
    if(osOrConstruct == "os"){
        window.location.href = "index.php?controller=shop&action=home&os=" + OsOrConstructor + "&order=" + value;
    }else if(osOrConstruct == "construct"){
        window.location.href = "index.php?controller=shop&action=home&constructor=" + OsOrConstructor + "&order=" + value;
    }
};