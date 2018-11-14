let url;
let gid;

$("document").ready(() => {
  url = new URL(window.location.href);
  gid = url.searchParams.get("gid");

  updateBoardDisplay();
})

function updateBoardDisplay() {
  $.get("ajax/board.php?gid=" + gid , function( data ) {
    data.forEach(move => {
      $("td[x="+move.x+"][y="+move.y+"]").text("X");
    });
  });

  setTimeout(updateBoardDisplay, 1000);
}
