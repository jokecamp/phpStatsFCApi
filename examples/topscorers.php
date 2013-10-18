<?php

# just contains a variable with my own $API_KEY set
require_once 'apikey.php';
require_once dirname(__FILE__).'/../src/statsFcApi.php';

$api = new StatsFcApi('http://api.statsfc.com/', $API_KEY, 'America/New_York');

echo "<h3>Top Scorers</h3>";
$data = $api->GetTopScorers('premier-league', null, '2013/2014');
foreach($data as $t) {
    $format = "%s - %s vs %s - %s %s<br>";
    echo sprintf($format, $t->player_id, $t->player, $t->team_id, $t->team, $t->goals);   
}

?>