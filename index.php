<?php
if (!defined('MINUTE')) define('MINUTE', 60);
if (!defined('HOUR'))   define('HOUR', 3600);
if (!defined('DAY'))    define('DAY', 86400);
if (!defined('MONTH'))  define('MONTH', 2592000);
if (!defined('YEAR'))   define('YEAR', 31536000);

class Time {
  public function agoInWords($then, $now = null) {
    if (!$now) $now = time();

    $then = strtotime($then);
    $diff = $now - $then;

    $years = floor($diff / YEAR);
    $diff -= $years * YEAR;

    $months = floor($diff / MONTH);
    $diff -= $months * MONTH;

    $days = floor($diff / DAY);
    $diff -= $days * DAY;

    $hours = floor($diff / HOUR);
    $diff -= $hours * HOUR;

    $minutes = floor($diff / MINUTE);
    $diff -= $minutes * MINUTE;

    $r = '';
    $hasOne = $hasYear = $hasMonth = $hasDay = false;

    if ($years > 0) {
      $r .= $this->pluralize($years, 'year');
      $hasOne = true;
      $hasYear = true;
    }

    if ($months > 0) {
      if ($hasOne) $r .= ', ';
      $r .= $this->pluralize($months, 'month');
      $hasOne = true;
      $hasMonth = true;
    }

    if (!$hasYear && $days > 0) {
      if ($hasOne) $r .= ', ';
      $r .= $this->pluralize($days, 'day');
      $hasOne = true;
      $hasDay = true;
    }

    if (!$hasYear && !$hasMonth && $hours > 0) {
      if ($hasOne) $r .= ', ';
      $r .= $this->pluralize($hours, 'hour');
      $hasOne = true;
    }

    if (!$hasYear && !$hasMonth && !$hasDay && $minutes > 0) {
      if ($hasOne) $r .= ', ';
      $r .= $this->pluralize($minutes, 'minute');
      $hasOne = true;
    }

    if ($hasOne) return $r . ' ago';
    return 'a few seconds ago';
  }

  public function pluralize($count, $single, $many = null) {
    if (!$many) $many = $single . 's';
    return $count . ' ' . ($count == 1 ? $single : $many);
  }
}