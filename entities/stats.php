<?php
class Stats {
  public $username;
  public $wins;
  public $losses;
  public $draws;

  public function __construct() {
    $this->wins = 0;
    $this->losses = 0;
    $this->draws = 0; 
  }
}