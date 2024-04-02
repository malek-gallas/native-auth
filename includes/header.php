<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23339933%22></rect><text x=%2250%%22 y=%2250%%22 dominant-baseline=%22central%22 text-anchor=%22middle%22 font-size=%2266%22>🔒</text></svg>" />
        <title>Native-Auth</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="includes/style.css">
    </head>
    <body>
        <script>
            // Get the user's timezone and send it to the server using AJAX
            var timezoneOffset = new Date().getTimezoneOffset();
            var timezoneOffsetHours = timezoneOffset / 60;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'scripts/set_timezone.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Timezone set successfully');
                } else {
                    console.log('Failed to set timezone');
                }
            };
            xhr.send('timezone_offset=' + timezoneOffsetHours);
        </script>