let url;
let gid;
let globalState;
let globalUser;
let playerNumber;
let isActivePlayer = false;

$("document").ready(() => {
  // We get the game id from the url and
  // store it into gid variable
  url = new URL(window.location.href);
  gid = url.searchParams.get("gid");

  // The player who created the game plays
  // first
  if(url.searchParams.get("host") === "true") {
    playerNumber = "1";
    isActivePlayer = true;
    $("#turn-indicator").collapse("show");
  }

  // We get the logged user id
  $.get("ajax/get-user.php", (user) => {
    globalUser = user;

    // Handle square click
    $(".square").click((square) => {
      if(!isActivePlayer) {
        // Player is not active
        return;
      }
      takeSquare(square.target.attributes.getNamedItem("x").value, square.target.attributes.getNamedItem("y").value);
    })
  
    updateGameStatus();
    updateBoardDisplay();
  })
})

function updateBoardDisplay() {
  $.get("ajax/board.php?gid=" + gid , function( data ) {
    let updated = false;
    data.forEach(move => {
      const square = $("td[x="+move.x+"][y="+move.y+"]");
      // If the square value changes
      if(square.text() === "") {
        updated = true;
        if(move.pid === globalUser) {
          square.text("X");
        } else {
          square.text("O");
        }
      }
    });

    // Update turn indicator
    if(data.length > 0) {
      if(data[data.length - 1].pid === globalUser) {
        isActivePlayer = false;
        $("#turn-indicator").collapse("hide");
      } else {
        isActivePlayer = true;
        $("#turn-indicator").collapse("show");
      }
    }

    // We check win only if a move is played
    if(updated) {
      checkWin();
    }
    
    setTimeout(updateBoardDisplay, 1000);
  });
}

function updateGameStatus() {
  $.get("ajax/game-state.php?gid=" + gid , function( data ) {
    globalState = data;
    const statusBox = $("#status");
    if (globalState === "-1") {
      // We wait for player to join
    } else if (globalState === "0") {
      // Game has started
      $("#wait").hide();
      $(".board-container").show();
      statusBox.hide();
    } else if (globalState === "3") {
      statusBox.addClass("alert-info");
      statusBox.text("Draw!");
      statusBox.show();
    } else if (globalState === playerNumber) {
      statusBox.addClass("alert-success");
      statusBox.text("You won!");
      statusBox.show();
    } else if (globalState !== playerNumber) {
      statusBox.addClass("alert-danger");
      statusBox.text("You lost");
      statusBox.show();
    } else {
      statusBox.addClass("alert-dark");
      statusBox.text("Error: " + status);
      statusBox.show();
    }
    
    setTimeout(updateGameStatus, 1000);
  });
}

function takeSquare(x, y) {
  const payload = {
    x: x,
    y: y,
    gid: gid
  }

  $.post("ajax/take-square.php", payload, (response) => {
    console.log(response)
  })
}

function checkWin() {
  $.get("ajax/check-win.php?gid=" + gid, (response) => {
    if (response !== globalState) {
      setGameState(response);
    }
  })
}

function setGameState(state) {
  const payload = {
    gstate: state,
    gid: gid
  }

  $.post("ajax/set-game-state.php", payload, (response) => {
    console.log(response)
  })
}

function getLoggedUser() {
  $.get("ajax/get-user.php", payload, (response) => {
    userId = response;
  })
}
