var level;

function getLevel(name) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      var resp = JSON.parse(this.responseText);
      level = resp;
      console.log(level);
    };
    xmlhttp.open("GET", "getLevel.php?q=" + name, true);
    xmlhttp.send();
}
getLevel("solvable");

function tileClicked(tile) {
  var numberTile = numberToCoordinate(tile);
  var blankTile = locateTile(16);
  if((numberTile[0] == blankTile[0] && ((numberTile[1] == blankTile[1] - 1) || (numberTile[1] == blankTile[1] + 1))) || 
  (numberTile[1] == blankTile[1] && ((numberTile[0] == blankTile[0] - 1) || (numberTile[0] == blankTile[0] + 1))) ){
    swapTiles(tile, level[numberTile[1]][numberTile[0]], coordinateToNumber(blankTile));
    swapValues(numberTile, blankTile);
  }
  
}

function swapTiles(numberTile, tileValue, blankTile,) {
  var numberTileDiv = document.getElementById("t" + numberTile);
  var blankTileDiv = document.getElementById("t" + blankTile);
  numberTileDiv.classList.remove("tile");
  numberTileDiv.classList.add("tile-n");
  numberTileDiv.innerHTML = "-";
  blankTileDiv.classList.remove("tile-n");
  blankTileDiv.classList.add("tile");
  blankTileDiv.innerHTML = tileValue;
}

function swapValues(coordinate1, coordinate2){
  console.log(level);
  var temp = level[coordinate1[1]][coordinate1[0]];
  level[coordinate1[1]][coordinate1[0]] = level[coordinate2[1]][coordinate2[0]];
  level[coordinate2[1]][coordinate2[0]] = temp;
  console.log(level)
}

function numberToCoordinate(number) {
  var x = (number - 1) % 4;
  var y = Math.floor((number - 1) / 4);
  return [x, y];
}

function coordinateToNumber(coordinate){
  var number = 1;
  number += coordinate[0]; 
  number += coordinate[1] * 4;
  return number;

}

function locateTile(value){
  for (var i = 0; i < level.length; i++) {
    for (var j = 0; j < level[0].length; j++) {
      if (level[j][i] == value) {
        return [i, j]
      }
    }
  }
}


