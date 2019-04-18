<?php

namespace Language;

use Language\GenerateLanguageFiles;
use Language\GetLanguageFile;
use Language\GenerateAppletLanguageXmlFiles;
use Language\GetAppletLanguages;

/**
 * Business logic related to generating language files.
 */
class LanguageBatch
{
	public function __construct(GenerateLanguageFiles $generateLanguageFiles, GetLanguageFile $getLanguageFile,
								GenerateAppletLanguageXmlFiles $generateAppletLanguageXmlFiles,
								GetAppletLanguages $getAppletLanguages)
	{
		$this->generateLanguageFiles = $generateLanguageFiles;
		$this->getLanguageFile = $getLanguageFile;
		$this->generateAppletLanguageXmlFiles = $generateAppletLanguageXmlFiles;
		$this->getAppletLanguages = $getAppletLanguages;
	}
	/**
	 * Contains the applications which ones require translations.
	 *
	 * @var array
	 */
	protected static $applications = array();

	/**
	 * Starts the language file generation.
	 *
	 * @return void
	 */
	public static function generateLanguageFiles()
	{
		return $this->generateLanguageFiles;
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
		return $this->getLanguageFile;
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
		return Config::get('system.paths.root') . '/cache/' . $application. '/';
	}

	/**
	 * Gets the language files for the applet and puts them into the cache.
	 *
	 * @throws Exception   If there was an error.
	 *
	 * @return void
	 */
	public static function generateAppletLanguageXmlFiles()
	{
		return $this->generateAppletLanguageXmlFiles;
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
		return $this->getAppletLanguages($applet);
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
		$result = ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'LanguageFiles',
				'action' => 'getAppletLanguageFile'
			),
			array(
				'applet' => $applet,
				'language' => $language
			)
		);

		try {
			self::checkForApiErrorResult($result);
		}
		catch (\Exception $e) {
			throw new \Exception('Getting language xml for applet: (' . $applet . ') on language: (' . $language . ') was unsuccessful: '
				. $e->getMessage());
		}

		return $result['data'];
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
		// Error during the api call.
		if ($result === false || !isset($result['status'])) {
			throw new \Exception('Error during the api call');
		}
		// Wrong response.
		if ($result['status'] != 'OK') {
			throw new \Exception('Wrong response: '
				. (!empty($result['error_type']) ? 'Type(' . $result['error_type'] . ') ' : '')
				. (!empty($result['error_code']) ? 'Code(' . $result['error_code'] . ') ' : '')
				. ((string)$result['data']));
		}
		// Wrong content.
		if ($result['data'] === false) {
			throw new \Exception('Wrong content!');
		}
	}
}
