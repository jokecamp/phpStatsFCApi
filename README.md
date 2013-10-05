phpStatsFCApi
=============

Very simple PHP code to quickly perform GETs against the football/soccer data at api.statscs.com 

Example usage:

```
require_once 'StatsFcApi.php';
$api = new StatsFcApi('http://api.statsfc.com/', 'YOUR API KEY HERE', 'America/New_York');

echo "<h3>Teams</h3>";
$teams = $api->GetTeams('premier-league', '2013/2014');
foreach($teams as $t) {
	$format = "%s %s %s %s <br>";
	echo sprintf($format, $t->id, $t->name, $t->nameshort, $t->path);	
}
```
