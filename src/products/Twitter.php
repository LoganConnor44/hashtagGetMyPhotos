<?php
namespace HashTagGetMyPhotos\Products;

use HashTagGetMyPhotos\Config\SocialMediaConfig;

/**
 * A Twitter class that inherits from the SocialMedia interface.
 */
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
	 * The image files for appropriate Tweets.
	 * @var array
	 */
	private $mediaFiles;

	/**
	 * The full response for appropriate Tweets with media.
	 * @var array
	 */
	private $tweetsWithMedia;

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
		$this->mediaFiles = array();
		$this->tweetsWithMedia = array();
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
		$url = "https://api.twitter.com/1.1/search/tweets.json";
		$getfield = "?q=%23" . $hashtag;
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
	 * Sets the tweet ID as the property key and the value, initially, to null.
	 * Sets the Responses property to have the tweet id as the object's key.
	 *
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
	public function saveResponseIds() : Twitter {
		foreach ($this->Responses->statuses as $dynamicIndex => $tweet) {
			$this->responseIds[$tweet->id] = NULL;
			$this->Responses->statuses[$tweet->id] = $tweet;
			unset($this->Responses->statuses[$dynamicIndex]);
		}
		return $this;
	}

	/**
	 * Searches and sets the Response property if appropriate Tweets are found.
	 *
	 * @param integer $id The id to search by.
	 *
	 * @return \stdClass
	 */
	public function retrieveResponseById(int $id) : \stdClass {
		$url = 'https://api.twitter.com/1.1/statuses/show.json';
		$getfield = '?id=' . $id;
		$requestMethod = 'GET';
		$twitter = new \TwitterAPIExchange($this->settings);
		return json_decode(
			$twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest()
		);
	}

	/**
	 * Searches responseIds and checks if there is a media property in the given object.
	 *
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
	public function doesMediaExist() : Twitter {
		foreach ($this->responseIds as $idKey => $hasMedia) {
			$Tweet = $this->retrieveResponseById($idKey);
			$this->responseIds[$idKey] = property_exists($Tweet->entities, 'media');
		}
		return $this;
	}

	/**
	 * Iterates through the responseIds and if a media url exists store the $idKey
	 * and the media_url_https in the property mediaFiles as an array.
	 *
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
	public function saveMediaFiles() : Twitter {
		foreach ($this->responseIds as $idKey => $hasMedia) {
			if ($hasMedia) {
				$this->mediaFiles[$idKey] =
					$this->Responses->statuses[$idKey]->entities->media[0]->media_url_https;
			}
		}
		return $this;
	}

	/**
	 * Iterates through the responseIds and if a media url exists store the $idKey
	 * and the entire tweet in the property tweetsWithMedia as an array.
	 *
	 * @return \HashTagGetMyPhotos\Products\Twitter
	 */
	public function saveTweetsWithMedia() : Twitter {
		foreach ($this->responseIds as $idKey => $hasMedia) {
			if ($hasMedia) {
				$this->tweetsWithMedia[(int) $idKey] =
					$this->Responses->statuses[$idKey];
			}
		}
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
	public function getResponseIds() : array {
		return $this->responseIds;
	}

	/**
	 * Gets the private property mediaFiles
	 *
	 * @return array
	 */
	public function getMediaFiles() : array {
		return $this->mediaFiles;
	}

	/**
	 * Gets the private property tweetsWithMedia
	 *
	 * @return array
	 */
	public function getTweetsWithMedia() : array {
		return $this->tweetsWithMedia;
	}
}