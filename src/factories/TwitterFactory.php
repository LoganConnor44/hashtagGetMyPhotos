<?php
namespace HashTagGetMyPhotos\Factory;

use HashTagGetMyPhotos\Products\SocialMedia;
use HashTagGetMyPhotos\Products\Twitter;

/**
 * A factory class to create a Twitter product/object.
 */
class TwitterFactory extends AbstractFactory {

	/**
	 * Calls the AbstractFactory constructor to verify that shape is valid
	 * @param array $config Type of platform to create.
	 * @return void
	 */
	public function __construct(array $config) {
		$nameOfPlatform = key($config);
		parent::__construct($nameOfPlatform);
	}
	
	/**
	 * Returns a Twitter object.
	 * @return Twitter
	 */
	public static function getPlatform() : SocialMedia {
			return new Twitter();
	}
}