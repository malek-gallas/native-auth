<?php
if (isset($_POST['timezone_offset'])) {
    $timezoneOffsetHours = $_POST['timezone_offset'];
    $timezoneName = timezone_name_from_abbr("", $timezoneOffsetHours * 60, false);
    if ($timezoneName !== false) {
        date_default_timezone_set($timezoneName);
        echo 'Timezone set to: ' . $timezoneName;
    } else {
        echo 'Failed to set timezone';
    }
} else {
    echo 'Timezone offset not provided';
}
?>