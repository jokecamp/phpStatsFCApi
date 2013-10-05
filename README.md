phpStatsFCApi
=============

Very simple PHP code to quickly perform GETs against the football/soccer JSON data at https://statsfc.com/

Stats FC is an API for Premier League, FA Cup and League Cup football results.

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
