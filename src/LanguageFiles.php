<?php

namespace Language;

class LanguageFiles
{

	public function __construct(Results $results, LanguageCache $languageCache)
	{
		$this->results = $results;
		$this->languageCache = $languageCache;
	}

	/**
	 * Contains the applications which ones require translations.
	 *
	 * @var array
	 */
	public static $applications = array();


    public function generateLanguageFiles()
    {
        // The applications where we need to translate.
		self::$applications = Config::get('system.translated_applications');
		echo "\nGenerating language files\n";
		foreach (self::$applications as $application => $languages) {
			echo "[APPLICATION: " . $application . "]\n";
			foreach ($languages as $language) {
				echo "\t[LANGUAGE: " . $language . "]";
				if ($this->getLanguageFile($application, $language)) {
					echo " OK\n";
				}
				else {
					throw new \Exception('Unable to generate language file!');
				}
			}
		}
	}
	
	public function getLanguageFile($application, $language)
	{
		$result = false;

		$languageResponse = $this->languageResponse($language);

		try {
			$this->results->checkForApiErrorResult($languageResponse);
		}
		catch (\Exception $e) {
			throw new \Exception('Error during getting language file: (' . $application . '/' . $language . ')');
		}

		// If we got correct data we store it.
		$destination = $this->languageCache->getLanguageCachePath($application) . $language . '.php';
		// If there is no folder yet, we'll create it.
		var_dump($destination);
		if (!is_dir(dirname($destination))) {
			mkdir(dirname($destination), 0755, true);
		}

		$result = $this->results->getResult($destination, $languageResponse);

		return (bool)$result;
	}

	protected function languageResponse($language)
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