<?php


    $json_url = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=flensburg,deutschland#sthash.Jo3gukz6.dpuf');

$json = file_get_contents($json_url);
$data = json_decode($json, TRUE);
echo "<pre>";
print_r($data);
echo "</pre>";


?>