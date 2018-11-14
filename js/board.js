$("document").ready(() => {
  var url = new URL(window.location.href);
  var gid = url.searchParams.get("gid");

  $.get("ajax/board.php?gid=" + gid , function( data ) {
    data.forEach(move => {
      $("td[x="+move.x+"][y="+move.y+"]").text("X");
    });
  });
})
