<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (isset($_GET['input'])) {
    $input = $_GET['input'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://89.116.34.245:6001/api/v1/auth/addFeedback');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['input' => $input]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
    } else {
        echo $result;
    }
    curl_close($ch);
} else {
    echo json_encode(['error' => 'No input provided']);
}
