<?php
if (!defined('MINUTE')) define('MINUTE',  60);
if (!defined('HOUR'))   define('HOUR',    3600);
if (!defined('DAY'))    define('DAY',     86400);
if (!defined('MONTH'))  define('MONTH',   2592000);
if (!defined('WEEK'))   define('WEEK',    604800);
if (!defined('YEAR'))   define('YEAR',    31536000);

class Time {
  var $hasOne   = false;
  var $hasYear  = false;
  var $hasMonth = false;
  var $hasWeek  = false;
  var $hasDay   = false;

  public function agoInWords($then, $now = null) {
    $this->rewind();
    if (!$now) $now = time();

    if (!is_numeric($then)) {
      $then = strtotime($then);
    }

    $diff = $now - $then;

    $years = floor($diff / YEAR);
    $diff -= $years * YEAR;

    $months = floor($diff / MONTH);
    $diff -= $months * MONTH;

    $weeks = floor($diff / WEEK);
    $diff -= $weeks * WEEK;

    $days = floor($diff / DAY);
    $diff -= $days * DAY;

    $hours = floor($diff / HOUR);
    $diff -= $hours * HOUR;

    $minutes = floor($diff / MINUTE);
    $diff -= $minutes * MINUTE;

    $r = '';

    if ($years > 0) {
      $r .= $this->sep() . $this->pluralize($years, 'year');
      $this->hasYear = true;
    }

    if ($months > 0) {
      $r .= $this->sep() . $this->pluralize($months, 'month');
      $this->hasMonth = true;
    }

    if (!$this->hasYear && $weeks > 0) {
      $r .= $this->sep() . $this->pluralize($weeks, 'week');
      $this->hasWeek = true;
    }

    if ($days > 0 && !$this->hasYear && !$this->hasMonth) {
      $r .= $this->sep() . $this->pluralize($days, 'day');
      $this->hasDay = true;
    }

    if ($hours > 0 && !$this->hasYear && !$this->hasMonth && !$this->hasWeek) {
      $r .= $this->sep() . $this->pluralize($hours, 'hour');
    }

    if ($minutes > 0 && !$this->hasYear && !$this->hasMonth && !$this->hasWeek && !$this->hasDay) {
      $r .= $this->sep() . $this->pluralize($minutes, 'minute');
    }

    if ($this->hasOne) return $r . ' ago';
    return 'a few seconds ago';
  }

  public function pluralize($count, $single, $many = null) {
    $this->hasOne = true;

    if (!$many) $many = $single . 's';
    return $count . ' ' . ($count == 1 ? $single : $many);
  }

  private function sep() {
    return $this->hasOne ? ', ' : '';
  }

  private function rewind() {
    $this->hasOne   = false;
    $this->hasYear  = false;
    $this->hasMonth = false;
    $this->hasWeek  = false;
    $this->hasDay   = false;
  }
}