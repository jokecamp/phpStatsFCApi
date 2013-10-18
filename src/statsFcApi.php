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
		Required:
			competition String, is the path of the competition
		Optional:
			team String, is the path of a team if you want only their fixtures, e.g., manchester-city, liverpool
			from Date, is the date to get fixtures from, e.g., 2012-09-01
			to Date, is the date to get fixtures to, e.g., 2012-12-31
			timezone String, is one of the following timezones  
			limit Integer, is the maximum number of fixtures to return	
	*/
	public function GetFixtures($comp, $max, $from, $to) {
		$params = array('limit' => $max, 
			'timezone' => $this->timezone,
			'to' => $to,
			'from' => $from);
		$url = $this->WithTrailingSlash($comp) . 'fixtures';
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
	
	/*
		Optional:
			competition New String, is the path of the competition  
			team New String, is the path of a team if you want only their results, e.g., manchester-city, liverpool
			year New String, is the year you want top scorers for, e.g., 2012/2013		
	*/
	public function GetTopScorers($comp, $team, $year) {
		$params = array('competition' => $comp, 'team' => $team, 'year' => $year);
		$url = $this->WithTrailingSlash($comp) . 'top-scorers';
		return $this->GetJson($url, $params);		
	}
}

?>
