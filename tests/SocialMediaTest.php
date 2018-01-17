<?php
use HashTagGetMyPhotos\Factory\FactoryProducer as FactoryProducer;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase {

	/**
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
	}
	
	public function testGetDefinitions() {
		$definitions = AbstractFactory::getDefinitions();
	}

	public function testTwitterFactory() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveHashtagResponses();
			//->searchForHashtag();
		//var_dump($Twitter->getReponseIds());
		print_r($Twitter->getResponses());
	}

	public function testGetTweetById() {
		$Factory = FactoryProducer::getFactory('twitter');
		$Twitter = $Factory->getPlatform();
		$Twitter->retrieveResponseById(953397999593508865);
		print_r($Twitter->getResponses());
	}
}