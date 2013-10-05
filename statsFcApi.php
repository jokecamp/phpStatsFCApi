<?php

/* 
	A simple wrapper for the StatsFC API for live scores and results.
	Written by Joe Kampschmidt
	10/5/2013
	See API documentation at https://statsfc.com/docs/api
*/
class StatsFcApi {
	public function __construct ($baseUrl, $apiKey, $timezone) {
        $this->apiKey = $apiKey;
		$this->baseUrl = $baseUrl;
		$this->timezone = $timezone;
	}
	
	// type = {League | Cup }
	public function GetCompetitions() {	
		$params = array('key'=> $this->apiKey, 'type'=>'League');	
		$url = $this->baseUrl . 'competitions.json?' . http_build_query($params);
		//echo $url . "<br>";
		$data = json_decode(file_get_contents($url));
		return $data;
	}

	//  ["id"]=> int(9825) ["name"]=> string(7) "Arsenal" ["nameshort"]=> string(7) "Arsenal" ["path"]=> string(7) "arsenal" 
	public function GetTeams($comp) {	
		$params = array('key'=> $this->apiKey, 'year'=>'2013/2014');	
		$url = $this->baseUrl . $comp . '/teams.json?' . http_build_query($params);
		//echo $url . "<br>";
		$data = json_decode(file_get_contents($url));
		return $data;
	}
	
	public function GetResults($comp) {
		$params = array('key'=> $this->apiKey, 'limit' => 25, 'timezone' => $this->timezone);
		$url = $this->baseUrl . $comp . '/results.json?' . http_build_query($params);
		//echo $url . "<br>";
		$data = json_decode(file_get_contents($url));
		return $data;			
	}
	
	public function GetLiveScores($comp) {
		$params = array('key'=> $this->apiKey, 'limit' => 25, 'timezone' => $this->timezone);
		$url = $this->baseUrl . $comp . '/live.json?' . http_build_query($params);
		//echo $url . "<br>";
		$data = json_decode(file_get_contents($url));
		return $data;			
	}
}


?>
