<?php
namespace HashTagGetMyPhotos\Products;

use HashTagGetMyPhotos\Config\SocialMediaConfig;

class Twitter extends SocialMedia {

	/**
	 * object
	 */
	private $Responses;

	/**
	 * array of int
	 */
	private $responseIds;

	/**
	 * array
	 */
	private $settings;
	
	public function __construct() {
		$this->name = 'Twitter';
		$this->responseIds = array();
		$this->settings = array(
			'oauth_access_token' => SocialMediaConfig::TWITTER_TOKEN,
			'oauth_access_token_secret' => SocialMediaConfig::TWITTER_TOKEN_SECRET,
			'consumer_key' => SocialMediaConfig::TWITTER_KEY,
			'consumer_secret' => SocialMediaConfig::TWITTER_SECRET
		);
	}

	public function retrieveHashtagResponses(string $hashtag) : Twitter {
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = '?q=%23' . $hashtag;
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

	public function getResponses() : \stdClass {
		return $this->Responses;
	}

	public function getReponseIds() : array {
		return $this->responseIds;
	}
}