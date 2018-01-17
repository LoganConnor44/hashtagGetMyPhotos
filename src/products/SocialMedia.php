<?php
namespace HashTagGetMyPhotos\Products;

/**
 * A parent abstract class for all requests to any social media platform
 */
abstract class SocialMedia {

	/**
	 * Name of the social media platform
	 * @var string
	 */
	protected $name;

	/**
	 * Returns the name of the Social Media object.
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}