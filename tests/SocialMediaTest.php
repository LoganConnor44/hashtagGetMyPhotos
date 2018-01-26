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
		$Tweet = $Twitter->retrieveResponseById(953397999593508865);
		$this->assertTrue(is_int($Tweet->id));
	}

	/**
	 * Verifies that the responseId property is an array.
	 *
	 * @return void
	 */
	public function testSaveIds() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses('goingSparrow')
			->saveResponseIds();
		$this->assertTrue(is_array($Twitter->getResponseIds()));
	}

	/**
	 * Verifies if the responseId property contains any media.
	 *
	 * @return void
	 */
	public function testHasMedia() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses('goingSparrow')
			->saveResponseIds()
			->doesMediaExist();
		foreach ($Twitter->getResponseIds() as $response) {
			$this->assertTrue(is_bool($response));
		}
	}

	/**
	 * Verifies that the mediaFile property is an array made up of integer key and a string value.
	 *
	 * @return void
	 */
	public function testSaveMediaFiles() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses('goingSparrow')
			->saveResponseIds()
			->doesMediaExist()
			->saveMediaFiles();
		foreach ($Twitter->getMediaFiles() as $id => $file) {
			$this->assertTrue(is_int($id));
			$this->assertTrue(is_string($file));
		}
	}

	/**
	 * Verifies that the mediaFile property is an array made up of integer key and a string value.
	 *
	 * @return void
	 */
	public function testSaveTweetsWithMedia() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses('goingSparrow')
			->saveResponseIds()
			->doesMediaExist()
			->saveTweetsWithMedia();
		foreach ($Twitter->getTweetsWithMedia() as $id => $tweet) {
			$this->assertTrue(is_int($id));
			$this->assertTrue(is_object($tweet));
		}
	}
}