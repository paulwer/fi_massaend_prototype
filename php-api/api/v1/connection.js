// Example
// apipost("/error/", {description: "HI", title:"HEyho", url: "index.php"}, function(status, obj) {
//     console.log(obj.result);
// });
// load encription

// requires jquery
var sha512 = document.createElement('script');
sha512.type = 'text/javascript';
sha512.src = '{{<url>}}js/sha512.js';
document.getElementsByTagName('head')[0].appendChild(sha512);
var jquery = document.createElement('script');
var apiurl = "{{<url>}}api/v1/";
function apiget(url, retfunc = function () { }, output = false) {
    if (output) console.log("Send Post Request: " + url);
    $.ajax({
        url: apiurl + url,
        method: "get",
        complete: function(xhr, textStatus) {
            var obj = JSON.parse(xhr.responseText);
            if (output || xhr.status >= 299) console.log("Recieve Post Result(" + xhr.status + "): " + xhr.responseText + " " + url + " " + this.data);
            retfunc(xhr.status, obj);
        } 
    });
}
function apipost(url, obj, retfunc = function () { }, output = false) {
    if (output) console.log("Send Post Request: " + url + JSON.stringify(obj));
    $.ajax({
        url: apiurl + url,
        data: obj,
        method: "post",
        complete: function(xhr, textStatus) {
            var obj = JSON.parse(xhr.responseText);
            if (output || xhr.status >= 299) console.log("Recieve Post Result(" + xhr.status + "): " + xhr.responseText + " " + url + " " + this.data);
            retfunc(xhr.status, obj);
        } 
    });
}
function apiput(url, obj, retfunc = function () { }, output = false) {
    if (output) console.log("Send Post Request: " + url + JSON.stringify(obj));
    $.ajax({
        url: apiurl + url,
        data: obj,
        method: "put",
        complete: function(xhr, textStatus) {
            var obj = JSON.parse(xhr.responseText);
            if (output || xhr.status >= 299) console.log("Recieve Post Result(" + xhr.status + "): " + xhr.responseText + " " + url + " " + this.data);
            retfunc(xhr.status, obj);
        } 
    });
}
function apidelete(url, obj, retfunc = function () { }, output = true) {
    if (output) console.log("Send Post Request: " + url + JSON.stringify(obj));
    $.ajax({
        url: apiurl + url,
        data: obj,
        method: "delete",
        complete: function(xhr, textStatus) {
            var obj = JSON.parse(xhr.responseText);
            if (output || xhr.status >= 299) console.log("Recieve Post Result(" + xhr.status + "): " + xhr.responseText + " " + url + " " + this.data);
            retfunc(xhr.status, obj);
        } 
    });
}
function apilogout(retfunc = function () { }, output = false) {
    apiget("logout", retfunc, output);
}
function apilogin(input, password, retfunc = function () { }, force = false, output = false) {
    if (password.length!=128) password=hex_sha512(password);
    apiget("login?email=" + input + "&password=" + password + ((force) ? '&force' : ''), function (status, obj) {
        retfunc(status, obj);
    }, output);

}
function apiadminlogin(input, password, retfunc = function () { }, output = false) {
    if (password.length!=128) password=hex_sha512(password);
    apiget("login?email=" + input + "&password=" + password +"&admin&force", function (status, obj) {
        retfunc(status, obj);
    }, output);
}
function apipostfile(url, file_data, obj = JSON.parse('{}'), retfunc = function() { }, output = false) {
    var form_data = new FormData();
    form_data.append("file", file_data.files[0]);
    $.ajax({
        url: apiurl + url,
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        complete: function(xhr, textStatus) {
            var obj = JSON.parse(xhr.responseText);
            if (output || xhr.status >= 299) console.log("Recieve Post Result(" + xhr.status + "): " + xhr.responseText + " " + url + " " + this.data);
            retfunc(xhr.status, obj);
        } 
    });
}