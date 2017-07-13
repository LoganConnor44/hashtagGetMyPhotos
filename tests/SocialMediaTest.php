<?php
use Factory\SocialMediaFactory;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase {
	
	public function testGetName() {
		$Twitter = SocialMediaFactory::getPlatform('twitter');
		$this->assertEquals('Twitter',$Twitter->getName());
	}

	public function testGuzzle() {
		$Twitter = SocialMediaFactory::getPlatform('twitter');
		var_dump($Twitter->getResponse());
	}
}