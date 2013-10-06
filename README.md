PHP Consumer for Stats FC API
=============================

Very simple PHP code to quickly perform GETs against the football/soccer JSON data at https://statsfc.com/ 
Stats FC is an API for Premier League, FA Cup and League Cup football results.

Written by a C# developer so please point out any issues/improvements you see in the PHP code.


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
Will yield the following (truncated) results:

	Teams
	9825 Arsenal Arsenal arsenal 
	10252 Aston Villa Aston Villa aston-villa 
	8344 Cardiff City Cardiff cardiff-city 
	8455 Chelsea Chelsea chelsea 
	....
