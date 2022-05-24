<?php

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

function timeago($time)
{
    $delta = time() - $time;

    if ($delta < 1 * MINUTE) {
        return $delta == 1 ? "en este momento" : "hace " . $delta . " segundos ";
    }
    if ($delta < 2 * MINUTE) {
        return "hace un minuto";
    }
    if ($delta < 45 * MINUTE) {
        return "hace " . floor($delta / MINUTE) . " minutos";
    }
    if ($delta < 90 * MINUTE) {
        return "hace una hora";
    }
    if ($delta < 24 * HOUR) {
        return "hace " . floor($delta / HOUR) . " hora(s)";
    }
    if ($delta < 48 * HOUR) {
        return "ayer";
    }
    if ($delta < 30 * DAY) {
        return "hace " . floor($delta / DAY) . " días";
    }
    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "el mes pasado" : "hace " . $months . " meses";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "el año pasado" : "hace " . $years . " años";
    }
}