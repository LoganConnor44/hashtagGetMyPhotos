<?php
namespace HashTagGetMyPhotos\Factory;

use HashTagGetMyPhotos\Products\SocialMedia;
use HashTagGetMyPhotos\Products\Twitter;

class TwitterFactory extends AbstractFactory {

	/**
	 * Calls the AbstractFactory constructor to verify that shape is valid
	 * @param array $config
	 * @return void
	 */
	public function __construct(array $config) {
		$nameOfPlatform = key($config);
		parent::__construct($nameOfPlatform);
	}
	
	public static function getPlatform() : SocialMedia {
			return new Twitter();
	}
}