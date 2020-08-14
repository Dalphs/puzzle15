var level;

//Ajax request der henter et specifikt level og om det kan løses.
function getLevel(name) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      var resp = JSON.parse(this.responseText);
      level = resp.level;
      showSolvable(resp.isSolvable);
    };
    xmlhttp.open("GET", "getLevel.php?q=" + name, true);
    xmlhttp.send();
}
// lige nu er det hardcoded hvilket level der hentes, 
// men planen er der skal være en form for drop down med muligheder
getLevel("rowone");
initKeyListeners();

//funktion der ændrer teksten og fortæller om levelet kan løses
function showSolvable(isSolvable) {
    var text = document.getElementById("solvableString");
    var container = document.getElementById("solvableContainer");
    container.classList.remove("wait");
    if (isSolvable) {
        container.classList.add("true");
        text.innerHTML = "Puzzle can be solved";
    } else {
        container.classList.add("false");
        text.innerHTML = "Puzzle can not be solved";
    }
}

//Click listener der er aktive på alle 16 brikker. Hvis den klikkede brik ligger ved siden af den blanke
// kaldes funktionerne der flytter brikkerne grafisk og i spillogikken
function tileClicked(tile) {
  var numberTile = numberToCoordinate(tile);
  var blankTile = locateTile(16);
  if((numberTile[0] == blankTile[0] && ((numberTile[1] == blankTile[1] - 1) || (numberTile[1] == blankTile[1] + 1))) || 
  (numberTile[1] == blankTile[1] && ((numberTile[0] == blankTile[0] - 1) || (numberTile[0] == blankTile[0] + 1))) ){
    swapTiles(tile, level[numberTile[1]][numberTile[0]], coordinateToNumber(blankTile));
    swapValues(numberTile, blankTile);
  }
  
}

// Funktion der byttter rundt brikkerne grafisk, så brugeren præsenteres for ændringerne
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

// Funktion der bytter værdierne i det array der holder styr på spillet
function swapValues(coordinate1, coordinate2){
  var temp = level[coordinate1[1]][coordinate1[0]];
  level[coordinate1[1]][coordinate1[0]] = level[coordinate2[1]][coordinate2[0]];
  level[coordinate2[1]][coordinate2[0]] = temp;
}

//Funktion der oversætter fra 1-dimentionelt til to dimensionelt
function numberToCoordinate(number) {
  var x = (number - 1) % 4;
  var y = Math.floor((number - 1) / 4);
  return [x, y];
}

//Funktion der oversætter fra to-dimensionelt til et-dimensionelt
function coordinateToNumber(coordinate){
  var number = 1;
  number += coordinate[0]; 
  number += coordinate[1] * 4;
  return number;

}

//funktion der finder koordinater for en bestemt værdi på boardet
function locateTile(value){
  for (var i = 0; i < level.length; i++) {
    for (var j = 0; j < level[0].length; j++) {
      if (level[j][i] == value) {
        return [i, j]
      }
    }
  }
}

function initKeyListeners(){
    document.addEventListener("keydown", function (event) {
        var blankCoordinate = locateTile(16);
        var numberCoordinate = [];
        var cont = false;
        switch (event.key){
            case 'ArrowUp':
                if (blankCoordinate[1] !== 0){
                    cont = true;
                    numberCoordinate[0] = blankCoordinate[0];
                    numberCoordinate[1] = blankCoordinate[1] - 1;
                }
                break;
            case 'ArrowDown':
                if (blankCoordinate[1] !== 3){
                    var cont = true;
                    numberCoordinate[0] = blankCoordinate[0];
                    numberCoordinate[1] = blankCoordinate[1] + 1;
                }
                break;
            case 'ArrowRight':
                if (blankCoordinate[0] !== 3){
                    cont = true;
                    numberCoordinate[0] = blankCoordinate[0] + 1;
                    numberCoordinate[1] = blankCoordinate[1];
                }
                break;
            case 'ArrowLeft':
                if (blankCoordinate[0] !== 0){
                    cont = true;
                    numberCoordinate[0] = blankCoordinate[0] - 1;
                    numberCoordinate[1] = blankCoordinate[1];
                }
                break;    
        }
        if(cont){
            console.log(numberCoordinate + " " + blankCoordinate)
            swapTiles(coordinateToNumber(numberCoordinate), level[numberCoordinate[1]][numberCoordinate[0]], coordinateToNumber(blankCoordinate));
            swapValues(numberCoordinate, blankCoordinate);
        }
    })
}

function getSolution(name){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      var resp = JSON.parse(this.responseText);
      console.log(resp);
    };
    xmlhttp.open("GET", "solveLevel.php?q=" + name, true);
    xmlhttp.send();
}
getSolution("rowone");


