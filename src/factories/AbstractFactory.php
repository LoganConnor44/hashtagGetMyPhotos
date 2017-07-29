<?php 
namespace HashTagGetMyPhotos\Factory;

/**
 * The top most parent Abstract class for all factory classes
 */
abstract class AbstractFactory {

	/**
	 * The locally stored definitions data for all available platforms
	 * @var array
	 */
	protected $platformDefinitions;

	/**
	 * Name of the platform that will be produced
	 * @var string
	 */
	protected $platformName;

	/**
	 * This constructor is called when a specific platform factory is instantiated and sets the protected $platformName if it is a valid platform
	 * @param string $platform
	 * @return void
	 */
	public function __construct(string $platform) {
		$platform = strtolower($platform);
		$this->platformName = $platform;
	}

	/**
	 * Reads the file names in the factory directory and verifies that the $platform has a valid class written for it
	 * @param string $platform
	 * @return bool
	 */
	public static function isGivenShapeValid(string $platform): bool {
		$directory = dirname(realpath(dirname(__FILE__))) .'/products';
		//array_diff() removes the dots that this function picks up
		$availableClass = array_diff(scandir($directory), array('..', '.'));
		$platform = strtolower($platform);

		foreach($availableClass as $index => &$availablePlatform) {
			$availablePlatform = strtolower(strrev(substr(strrev($availablePlatform), 4)));
		}

		if (!in_array($platform, $availableClass)) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Retrieves definitions file that is stored locally and searches for the key (factory name) that is associated with an individual platform
	 * @param string $platform
	 * @return string
	 */
	public static function getExpectedFactoryFromShape(string $platform) : string {
		$definitions = self::getDefinitions();
		return array_search($platform, $definitions);
	}

	/**
	 * Reads then returns the definitions file that is stored locally
	 * @return array
	 */
	public static function getDefinitions() : array {
		$directory = dirname(realpath(dirname(__FILE__))) .'/definitions';
		$definitions = json_decode(file_get_contents($directory . DIRECTORY_SEPARATOR . 'shapes.json'), TRUE);
		return $definitions;
	}

	/**
	 * Reads the file names in the factories directory and verifies that the $factoryType has a valid class written for it
	 * @param string $factoryType
	 * @return bool
	 */
	public static function isGivenFactoryValid(string $factoryType): bool {
		$directory = dirname(realpath(dirname(__FILE__))) .'/factories';
		//array_diff() removes the dots that this function picks up
		$availableFactoryObjects = array_diff(scandir($directory), array('..', '.'));
		$factoryType = strtolower($factoryType);

		foreach($availableFactoryObjects as $index => &$factory) {
			$factory = strtolower(strrev(substr(strrev($factory), 4)));
		}

		if (!in_array($factoryType, $availableFactoryObjects)) {
			return FALSE;
		}
		return TRUE;
	}
}