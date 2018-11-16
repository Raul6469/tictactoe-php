<?php
class Util {
  public static function findUsernameInStatsList($list, $username) {
    foreach($list as $elem) {
      if ($elem->username == $username) {
        return $elem;
      }
    }
  }

  public static function sortStatsList($list) {
    function cmp($a, $b) {
        if ($a->wins == $b->wins) {
            return 0;
        }
        return ($a->wins < $b->wins) ? 1 : -1;
    }

    usort($list, "cmp");

    return $list;
  }
}