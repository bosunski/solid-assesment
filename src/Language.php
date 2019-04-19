<?php

namespace Language;

use \Language\Validators\API;


class Language
{

    public static function getFile($application, $language)
	{
		$result = false;

		try {
			API::checkForErrorResult(self::callLanguageApi($language));
		}
		catch (\Exception $e) {
			throw new \Exception('Error during getting language file: (' . $application . '/' . $language . ')');
		}

		return (bool) self::storeLanguageData($application, $language);
	}

	public function storeLanguageData($application, $language)
	{
		// If we got correct data we store it.
		$destination = Cache::getLanguageCachePath($application) . $language . '.php';
		// If there is no folder yet, we'll create it.
		var_dump($destination);
		if (!is_dir(dirname($destination))) {
			mkdir(dirname($destination), 0755, true);
		}

		return file_put_contents($destination, self::callLanguageApi($language)['data']);
	}

	public static function callLanguageApi($language)
	{
		return ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'LanguageFiles',
				'action' => 'getLanguageFile'
			),
			array('language' => $language)
		);	
	}
}