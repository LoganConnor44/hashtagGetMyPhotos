<?php
namespace HashTagGetMyPhotos\Products;

use HashTagGetMyPhotos\Config\SocialMediaConfig;

class Twitter extends SocialMedia {

	/**
	 * All responses from Twitter.
	 * @var object
	 */
	private $Responses;

	/**
	 * The reponse IDs from from each status.
	 * @var array
	 */
	private $responseIds;

	/**
	 * The configuration for connecting to Twitter.
	 * @var array
	 */
	private $settings;
	
	/**
	 * Defines the name property.
	 * Defines the reponseId property with an empty array.
	 * Defines the settings property with appropriate credentials.
	 * @return void
	 */
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

	/**
	 * Searches and sets the Response property if appropriate Tweets are found.
	 * 
	 * @param string $hashtag The hashtag to search by.
	 * 
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
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

	/**
	 * Searches and sets the Response property if appropriate Tweets are found.
	 * 
	 * @param int $id The id to search by.
	 * 
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
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

	/**
	 * Gets the private property Responses.
	 * 
	 * @return \stdClass
	 */
	public function getResponses() : \stdClass {
		return $this->Responses;
	}

	/**
	 * Gets the private property responseIds.
	 * 
	 * @return array
	 */
	public function getReponseIds() : array {
		return $this->responseIds;
	}
}