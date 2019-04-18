<?php

namespace Language;

use \Language\Validators\ValidateAPI;


class Language
{
    public static function getFile($application, $language)
	{
		$result = false;
		$languageResponse = ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'LanguageFiles',
				'action' => 'getLanguageFile'
			),
			array('language' => $language)
		);

		try {
			ValidateAPI::checkForApiErrorResult($languageResponse);
		}
		catch (\Exception $e) {
			throw new \Exception('Error during getting language file: (' . $application . '/' . $language . ')');
		}

		// If we got correct data we store it.
		$destination = Cache::getLanguageCachePath($application) . $language . '.php';
		// If there is no folder yet, we'll create it.
		var_dump($destination);
		if (!is_dir(dirname($destination))) {
			mkdir(dirname($destination), 0755, true);
		}

		$result = file_put_contents($destination, $languageResponse['data']);

		return (bool)$result;
	}
}