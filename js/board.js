let url;
let gid;
let status;

$("document").ready(() => {
  url = new URL(window.location.href);
  gid = url.searchParams.get("gid");

  updateBoardDisplay();
  updateGameStatus();
})

function updateBoardDisplay() {
  $.get("ajax/board.php?gid=" + gid , function( data ) {
    data.forEach(move => {
      $("td[x="+move.x+"][y="+move.y+"]").text("X");
    });
    setTimeout(updateBoardDisplay, 1000);
  });
}

function updateGameStatus() {
  $.get("ajax/game-state.php?gid=" + gid , function( data ) {
    status = data;
    const statusBox = $("#status");
    if(status === "-1") {
      statusBox.show();
      statusBox.text("Waiting for second player to join...")
    } else if (status === "0") {
      $(".board-container").show();
      statusBox.hide();
    } else if (status === "1") {
      statusBox.show();
      statusBox.text("You won!");
    } else if (status === "2") {
      statusBox.show();
      statusBox.text("You lost");
    } else if (status === "3") {
      statusBox.show();
      statusBox.text("Draw!");
    } else {
      statusBox.show();
      statusBox.text("Error: " + status);
    }
    
    setTimeout(updateGameStatus, 1000);
  });
}
