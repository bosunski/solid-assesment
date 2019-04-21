<?php

namespace Language;

class LanguageFiles
{
	/**
	 * Contains the applications which ones require translations.
	 *
	 * @var array
	 */
	protected static $applications = array();


    public static function generateLanguageFiles()
    {
		// The applications where we need to translate.
		
		self::$applications = Config::get('system.translated_applications');

		echo "\nGenerating language files\n";

		foreach (self::$applications as $application => $languages) 
		{
			echo "[APPLICATION: " . $application . "]\n";

			foreach ($languages as $language) 
			{
				echo "\t[LANGUAGE: " . $language . "]";

				if (self::getLanguageFile($application, $language)) 
				{
					echo " OK\n";
				}
				else {
					throw new \Exception('Unable to generate language file!');
				}
			}
		}
	}
	
	public static function getLanguageFile($application, $language)
	{
		$result = false;

		$languageResponse = self::LanguageResponse($language);

		try 
		{
			Results::checkForApiErrorResult($languageResponse);
		}
		catch (\Exception $e) 
		{
			throw new \Exception('Error getting language file: (' . $application . '/' . $language . ')');
		}

		// If we got correct data we store it.

		$destination = LanguageCache::getLanguageCachePath($application) . $language . '.php';

		// If there is no folder yet, we'll create it.

		var_dump($destination);

		if (!is_dir(dirname($destination))) 
		{
			mkdir(dirname($destination), 0755, true);
		}

		$result = Results::getResult($destination, $languageResponse);

		return (bool)$result;
	}


	protected static function languageResponse($language)
	{
		return Response::languageResponse('getLanguageFile', $language);
	}

}