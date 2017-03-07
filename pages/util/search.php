<?php

$url = "https://api.legiscan.com/?" . http_build_query($_POST);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$result = curl_exec($curl);

/* For some reason, legiScan seems to attach an extra char
 * to the end of it's result
 */
if (substr($result, -1) != "}") {
    $result = substr($result, 0, -1);
}

curl_close($curl);

echo $result;

?>
