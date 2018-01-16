<?php
namespace HashTagGetMyPhotos\Products;

use GuzzleHttp\Client;

/**
 * A parent abstract class for all requests to any social media platform
 */
abstract class SocialMedia {

	/**
	 * Name of the social media platform
	 */
	protected $name;

	public function getName() {
		return $this->name;
	}

	public function getResponse() {
		$Client = new Client([
		    // Base URI is used with relative requests
		    'base_uri' => 'http://httpbin.org/get',
		    // You can set any number of default request options.
		    'timeout'  => 2.0,
		]);
		return $Client->get();
	}
}