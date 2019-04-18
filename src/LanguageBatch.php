<?php

namespace Language;

use Language\LanguageFiles;
use Language\AppletLanguages;
use Language\CheckResult;
use Language\LanguageCache;

/**
 * Business logic related to generating language files.
 */
class LanguageBatch
{
	public function __construct(LanguageFiles $languageFiles, AppletLanguages $appletLanguages,
								Results $results, LanguageCache $languageCache)
	{
		$this->languageFiles = $languageFiles;
		$this->appletLanguages= $appletLanguages;
		$this->results = $results;
		$this->languageCache = $languageCache;
	}
	/**
	 * Contains the applications which ones require translations.
	 *
	 * @var array
	 */
	public static $applications = array();

	/**
	 * Starts the language file generation.
	 *
	 * @return void
	 */
	public function generateLanguageFiles()
	{
		// var_dump($x);die;
		return $this->languageFiles->generateLanguageFiles();
	}

	/**
	 * Gets the language file for the given language and stores it.
	 *
	 * @param string $application   The name of the application.
	 * @param string $language      The identifier of the language.
	 *
	 * @throws CurlException   If there was an error during the download of the language file.
	 *
	 * @return bool   The success of the operation.
	 */
	protected static function getLanguageFile($application, $language)
	{
		return $this->languageFiles->getLanguageFile($application, $language);
	}

	/**
	 * Gets the directory of the cached language files.
	 *
	 * @param string $application   The application.
	 *
	 * @return string   The directory of the cached language files.
	 */
	protected static function getLanguageCachePath($application)
	{
		return $this->languageCache->getLanguageCachePath($application);
	}

	/**
	 * Gets the language files for the applet and puts them into the cache.
	 *
	 * @throws Exception   If there was an error.
	 *
	 * @return void
	 */
	public function generateAppletLanguageXmlFiles()
	{
		return $this->appletLanguages->generateAppletLanguageXmlFiles();
	}

	/**
	 * Gets the available languages for the given applet.
	 *
	 * @param string $applet   The applet identifier.
	 *
	 * @return array   The list of the available applet languages.
	 */
	protected static function getAppletLanguages($applet)
	{
		return $this->appletLanguages->getAppletLanguages($applet);
	}


	/**
	 * Gets a language xml for an applet.
	 *
	 * @param string $applet      The identifier of the applet.
	 * @param string $language    The language identifier.
	 *
	 * @return string|false   The content of the language file or false if weren't able to get it.
	 */
	protected static function getAppletLanguageFile($applet, $language)
	{
		return $this->appletLanguages->getAppletLanguageFile($applet, $language);
	}

	/**
	 * Checks the api call result.
	 *
	 * @param mixed  $result   The api call result to check.
	 *
	 * @throws Exception   If the api call was not successful.
	 *
	 * @return void
	 */
	protected static function checkForApiErrorResult($result)
	{
		return $this->results->checkForApiErrorResult($result);
	}
}
