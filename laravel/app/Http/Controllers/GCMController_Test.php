<?php
  
$data = array('message' => 'Hello World!');   
$ids = array('AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE', 'def');

// Send push notification via Google Cloud Messaging
sendPushNotification($data, $ids);

function sendPushNotification($data, $ids)
{
    $apiKey = 'AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE';

    // Set POST request body
    $post = array(
                    'registration_ids'  => $ids,
                    'data'              => $data,
                 );

    // Set CURL request headers 
    $headers = array( 
                        'Authorization: key=' . $apiKey,
                        'Content-Type: application/json'
                    );

    // Initialize curl handle       
    $connection = curl_init();

    // Set URL to GCM push endpoint     
    curl_setopt($connection, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');

    // Set request method to POST       
    curl_setopt($connection, CURLOPT_POST, true);

    // Set custom request headers       
    curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);

    // Get the response back as string instead of printing it       
    curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);

    // Set JSON post data
    curl_setopt($connection, CURLOPT_POSTFIELDS, json_encode($post));

    // Actually send the request    
    $result = curl_exec($connection);

    // Handle errors
    if (curl_errno($connection))
    {
        echo 'GCM error: ' . curl_error($connection);
    }

    // Close curl handle
    curl_close($connection);

    // Debug GCM response       
    echo $result;
}
?>