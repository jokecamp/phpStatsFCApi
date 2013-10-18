<?php

# just contains a variable with my own $API_KEY set
require_once 'apikey.php';
require_once dirname(__FILE__).'/../src/statsFcApi.php';

$api = new StatsFcApi('http://api.statsfc.com/', $API_KEY, 'America/New_York');

echo "<h3>Teams</h3>";
$teams = $api->GetTeams('premier-league', '2013/2014');
foreach($teams as $t) {
    $format = "%s %s %s %s <br>";
    echo sprintf($format, $t->id, $t->name, $t->nameshort, $t->path);   
}

?>