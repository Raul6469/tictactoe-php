let url;
let gid;
let globalState;
let globalUser;
let playerNumber;
let isActivePlayer = false;

$("document").ready(() => {
  url = new URL(window.location.href);
  gid = url.searchParams.get("gid");

  if(url.searchParams.get("host") === "true") {
    playerNumber = "1";
    isActivePlayer = true;
  }

  $.get("ajax/get-user.php", (user) => {
    globalUser = user;

    $(".square").click((square) => {
      if(!isActivePlayer) {
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
      if(square.text() === "") {
        updated = true;
        if(move.pid === globalUser) {
          square.text("X");
        } else {
          square.text("O");
        }
      }
    });

    if(data.length > 0) {
      if(data[data.length - 1].pid === globalUser) {
        isActivePlayer = false;
      } else {
        isActivePlayer = true;
      }
    }

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
    if(globalState === "-1") {
      statusBox.show();
      statusBox.text("Waiting for second player to join...")
    } else if (globalState === "0") {
      $(".board-container").show();
      statusBox.hide();
    } else if (globalState === playerNumber) {
      statusBox.show();
      statusBox.text("You won!");
    } else if (globalState !== playerNumber) {
      statusBox.show();
      statusBox.text("You lost");
    } else if (globalState === "3") {
      statusBox.show();
      statusBox.text("Draw!");
    } else {
      statusBox.show();
      statusBox.text("Error: " + status);
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
