//Is javascript enabled ?
var e = document.getElementsByTagName("html")[0];
if ( e.className.match(/no-js/) ) {
    e.className = e.className.replace("no-js", "js")
}
