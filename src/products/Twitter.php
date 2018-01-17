<?php
namespace HashTagGetMyPhotos\Products;

class Twitter extends SocialMedia {

	/**
	 * object
	 */
	private $Responses;

	/**
	 * array of int
	 */
	private $responseIds;
	
	public function __construct() {
		$this->name = 'Twitter';
		$this->responseIds = array();
		$this->settings = array(
			'oauth_access_token' => "",
			'oauth_access_token_secret' => "",
			'consumer_key' => "",
			'consumer_secret' => ""
		);
	}

	public function retrieveHashtagResponses() : Twitter {
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = '?q=%23goingsparrow';
		$requestMethod = 'GET';
		$twitter = new \TwitterAPIExchange($this->settings);
		$this->Responses = json_decode(
			$twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest()
		);

		return $this;
	}

	public function retrieveResponseById(int $id) : Twitter {
		$url = 'https://api.twitter.com/1.1/statuses/show.json';
		$getfield = '?id=' . $id;
		$requestMethod = 'GET';
		$twitter = new \TwitterAPIExchange($this->settings);
		$this->Responses = json_decode(
			$twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest()
		);

		return $this;
	}

	// public function searchForHashtag() {
	// 	foreach ($this->Responses->statuses as $response) {
	// 		foreach ($response->entities->hashtags as $hashtag) {
	// 			if (strtolower($hashtag->text) === 'goingsparrow') {
	// 				$this->responseIds[] = $response->id;
	// 			}
	// 		}
	// 	}
	// }

	public function getResponses() : \stdClass {
		return $this->Responses;
	}

	public function getReponseIds() : array {
		return $this->responseIds;
	}
}