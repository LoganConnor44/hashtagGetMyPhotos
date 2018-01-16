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
		$Twitter->retrieveResponses()
			->searchForHashtag();
		var_dump($Twitter->getReponseIds());
	}
}