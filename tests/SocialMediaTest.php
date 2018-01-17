<?php
use HashTagGetMyPhotos\Factory\FactoryProducer as FactoryProducer;
use PHPUnit\Framework\TestCase;

/**
 * A unit testing class for all SocialMedia children objects.
 */
class SocialMediaTest extends TestCase {

	/**
	 * Verifies that the Abstract class is valid.
	 *
	 * @return void
	 */
	public function testMockingObject() {
		$mock = $this->getMockForAbstractClass(
			'HashTagGetMyPhotos\Factory\AbstractFactory',
			$arguments = array('twitter'),
			$mockClassName = 'AbstractFactory',
			$callOriginalConstructor = TRUE,
			$callOriginalClone = TRUE,
			$callAutoload = TRUE,
			$mockedMethods = array()
		);
		$this->assertTrue($mock instanceof \HashTagGetMyPhotos\Factory\AbstractFactory);
	}

	/**
	 * Verifies that the Twitter object is created and the hashtag is returned.
	 * @internal Note that this hashtag must be used within the past week.
	 *
	 * @return void
	 */
	public function testTwitterFactory() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses('goingSparrow');
		$this->assertTrue(is_object($Twitter->getResponses()));
	}

	/**
	 * Verifies that the Twitter object is created and Tweet based on an id is returned.
	 * @internal Unsure if ids are restricted to the previous week.
	 *
	 * @return void
	 */
	public function testGetTweetById() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveResponseById(953397999593508865);
		$this->assertTrue(is_int($Twitter->getResponses()->id));
	}
}