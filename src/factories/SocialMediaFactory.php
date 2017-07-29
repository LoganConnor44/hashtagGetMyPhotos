<?php
namespace Factory;

use Factory\Products\SocialMedia;
use Factory\Products\Twitter;

class SocialMediaFactory {
	
	public static function getPlatform(string $platform) : SocialMedia {
		$platform = strtoupper($platform);
		if ($platform === 'TWITTER') {
			return new Twitter();
		}
	}
}