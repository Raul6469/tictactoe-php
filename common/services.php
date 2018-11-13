<?php

require_once("entities/game.php");

class Services {
  public static function showOpenGames() {
    require_once("common/soap-client.php");
  
    $result = $soapClient->showOpenGames()->return;
  
    $gamesString = explode("\n", $result);
    
    $games = array();
    
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