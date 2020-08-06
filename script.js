function tileClicked(tile){
    console.log("Virker" + tile);
}
var level;

function getLevel(name){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      console.log(this.responseText)
    };
    xmlhttp.open("GET", "getLevel.php?q=" + name, true);
    xmlhttp.send();
}
getLevel("solvable");


