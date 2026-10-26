<?php
declare(strict_types=1);

/**
 * table output/lookup
 * @param string $caption Text displayed across the table's three columns.
 */

function fn_tableOpen(string $caption): void
{
    $escapedCaption = htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');

    echo '<table id="weekly-planner" class="weekly-planner">' . "\n";
    echo "    <thead>\n";
    echo '        <tr class="weekly-planner__caption-row">' . "\n";
    echo '            <th class="weekly-planner__caption" colspan="3">'
        . $escapedCaption . "</th>\n";
    echo "        </tr>\n";
    echo '        <tr class="weekly-planner__headings">' . "\n";
    echo '            <th class="weekly-planner__heading" scope="col">Day</th>' . "\n";
    echo '            <th class="weekly-planner__heading" scope="col">Details</th>' . "\n";
    echo '            <th class="weekly-planner__heading" scope="col">Time</th>' . "\n";
    echo "        </tr>\n";
    echo "    </thead>\n";
    echo "    <tbody>\n";
}

/**
 * closes planner body and table
 */
function fn_tableClose(): void
{
    echo "    </tbody>\n";
    echo "</table>\n";
}

/**
 * outputs a regular planner row
 *
 * @param string $day
 * @param string $details
 * @param string $time
 */

function fn_tableRow(string $day, string $details, string $time): void
{
    echo "<tr>\n";
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . "</td>\n";
    echo "</tr>\n";
}