<?php
class Util {
  public static function findUsernameInStatsList($list, $username) {
    foreach($list as $elem) {
      if ($elem->username == $username) {
        return $elem;
      }
    }
  }
}