<?php

$searchState = $_POST["state"];
$APIkey = $_POST["APIkey"];

$call = "https://api.legiscan.com/?key=$APIkey&op=search&state=$searchState";



?>
