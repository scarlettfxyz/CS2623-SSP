<?php
declare(strict_types=1);

/*
 * SSP03: weekly planner with functions
 */


require_once __DIR__ . '/PHP/functions_ssp03.php';
require_once __DIR__ . '/PHP/include_header.php';

    // central timezone
    $tz = new DateTimeZone('America/Chicago');
    $now = new DateTime('now', $tz);

    // returns days of the week
    $current_day = (int) $now->format('N');

fn_tableOpen('CS2623 Weekly Study Planner');


    // loops days of the week and highlight the current day
    for ($day = 1; $day <= 7; $day++) {
        $name = fn_dayOfWeek($day);
        $details = fn_dayDetails($day);
        $time = fn_dayTime($day);

        if ($day === $current_day) {
            fn_tableRowCurrent($name, $details, $time);
        } else {
            fn_tableRow($name, $details, $time);
        }
    }


fn_tableClose();

require_once __DIR__ . '/PHP/include_footer.php';