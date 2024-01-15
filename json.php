<?php
$api = 'https://universities.hipolabs.com/search?country=Italy';

// Fetch data from the API endpoint
$data = file_get_contents($api);

// Convert JSON string to a PHP array
$array = json_decode($data, true);

// Convert PHP array to JSON
$json = json_encode($array);

// Print the JSON output
echo $json;
?>