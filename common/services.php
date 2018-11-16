<?php

require_once("entities/game.php");
require_once("entities/stats.php");

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

  public static function joinGame($uid, $gid) {
    require_once("common/soap-client.php");

    $params = array(
      "uid" => $uid,
      "gid" => $gid,
    );

    $result = $soapClient->joinGame($params)->return;

    return $result;
  }

  public static function getUserStats($uid, $username) {
    require_once("common/soap-client.php");

    $params = array(
      "uid" => $uid
    );

    $gamesString = $soapClient->showAllMyGames($params)->return;

    $gameStrings = explode("\n", $gamesString);

    $stats = new Stats();

    foreach($gameStrings as $gameString) {
      $game = new Game();
      $gameElems = explode(",", $gameString);

      $game->id = $gameElems[0];
      $game->p1 = $gameElems[1];
      $game->p2 = $gameElems[2];
      
      $checkWinParams = array(
        "gid" => $game->id,
      );

      try {
        $gameState = $soapClient->checkWin($checkWinParams)->return;
        $game->state = $gameState;
      } catch(Exception $e) {
        continue;
      }

      if ($game->state === "0") {
        // Game still in progress
      } else if ($game->state == "3") {
        $stats->draws++;
      } else if (($game->state == "1" && $game->p1 == $username) || ($game->state == "2" && $game->p2 == $username)) {
        $stats->wins++;
      } else {
        $stats->losses++;
      }
    }

    return $stats;
  }

}