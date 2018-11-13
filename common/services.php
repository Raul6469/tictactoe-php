<?php

require_once("entities/game.php");

class Services {
  public static function showOpenGames() {
    require_once("common/soap-client.php");
  
    $result = $soapClient->showOpenGames()->return;
    $games = array();

    if (strpos($result, 'ERROR') !== false) {
      return $games;
    }

    $gamesString = explode("\n", $result);
    
    foreach($gamesString as $gameString) {
      $game = new Game();
      $gameElems = explode(",", $gameString);
      $game->id = $gameElems[0];
      $game->p1 = $gameElems[1];
      $game->started = $gameElems[2];
      
      array_push($games, $game);
    }
  
    return $games;
  }
}