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
	
	private function WithTrailingSlash($url) {
		return rtrim($url, '/') . '/';
	}
	
	public function GetJson($url, $params) {
		$params['key'] = $this->apiKey; 
		$url = $this->WithTrailingSlash($this->baseUrl) . 
				$url . '.json?' . http_build_query($params);
		//echo $url;
		return json_decode(file_get_contents($url));
	}
	
	/*
		$type can be "League" or "Cup"
	*/
	public function GetCompetitions($type) {	
		$params = array('type'=>$type);	
		$url = 'competitions';
		return $this->GetJson($url, $params);
	}

	/* 
		$comp = 'premier-league'
		$year = '2013/2014'
	*/
	public function GetTeams($comp, $year) {	
		$params = array('year'=> $year);	
		$url = $this->WithTrailingSlash($comp) . 'teams';
		return $this->GetJson($url, $params);
	}
	
	public function GetResults($comp, $max) {
		$params = array('limit' => $max, 'timezone' => $this->timezone);
		$url = $this->WithTrailingSlash($comp) . 'results';
		return $this->GetJson($url, $params);			
	}

	/* 
		Only returns results if there are current games for given competition.
		If no games are live response is {"error":"No live games found"}
	*/
	public function GetLiveScores($comp, $max) {
		$params = array('limit' => $max, 'timezone' => $this->timezone);
		$url = $this->WithTrailingSlash($comp) . 'live';
		return $this->GetJson($url, $params);		
	}
}

?>
