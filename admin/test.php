<?php
    // Create a curl handle
    $ch = curl_init('http://www.yahoo.com/');

    // Execute
    curl_exec($ch);

    // Check if any error occured
    if(!curl_errno($ch)) {
        $info = curl_getinfo($ch);
        echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
    }

    // Close handle
    curl_close($ch);
?>