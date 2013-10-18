<?php

# just contains a variable with my own $API_KEY set
require_once 'apikey.php';
require_once dirname(__FILE__).'/../src/statsFcApi.php';

$api = new StatsFcApi('http://api.statsfc.com/', $API_KEY, 'America/New_York');

echo "<h3>Fixtures</h3>";

$today = date('Y-m-d');
$endDate = date('Y-m-d', strtotime("+14 days"));
$data = $api->GetFixtures('premier-league', '50', $today, $endDate);
echo "<p>" . $today . " to " . $endDate . "</p>";
foreach($data as $t) {
    $format = "%s - %s vs %s - %s <br>";
    echo sprintf($format, $t->date, $t->home, $t->away, $t->status);   
}

?>