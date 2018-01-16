<?php 
namespace HashTagGetMyPhotos\Factory;

use HashTagGetMyPhotos\Factory\AbstractFactory;

/**
 * A factory class which holds the logic of which factory needs to be instaniated for the desired product
 */
class FactoryProducer extends AbstractFactory {

	/**
	 * Takes in a $platform and if it is an expected type is will return the appropriate factory object
	 * 
	 * When $typeAvailable is being defined we are substracting 1 from $numberOfKey because we need to account for zero-indexing
	 * @param string $platform
	 * @throws Exception
	 */
	public static function getFactory(string $platform) : AbstractFactory {
		try {
			$platformDefinitions = AbstractFactory::getDefinitions();
			$validPlatform = AbstractFactory::isGivenPlatformValid($platform);
			$expectedFactory = AbstractFactory::getExpectedFactoryFromPlatform($platform);
			$validFactory = AbstractFactory::isGivenFactoryValid($expectedFactory);

			if (!$validPlatform && !$validFactory) {
				throw new \Exception("Shape given does not have a corresponding class defined.");
			}
		} catch (Exception $e) {
			echo "Exception Caught: ", $e->getMessage(), "\n";
		}
		$availablePlatform = array_keys($platformDefinitions);
		$numberOfPlatforms = count($availablePlatform);
		while ($numberOfPlatforms > 0) {
			$typeAvailable = $availablePlatform[$numberOfPlatforms - 1];
			
			$platform = strtolower($platform);
			if (in_array($platform, $availablePlatform)) {
				$platformConfig = array(
					$platform => $availablePlatform
				);
				$factoryClass = 'HashTagGetMyPhotos\\Factory\\' . ucfirst($platform) . 'Factory';
				return new $factoryClass($platformConfig);
			}
			$numberOfPlatforms--;
		}
	}
}