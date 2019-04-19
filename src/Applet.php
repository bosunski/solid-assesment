<?php

namespace Language;

use Language\Validators\API;
use Language\Validators\Language;

class Applet
{

    
	/**
	 * Gets the language files for the applet and puts them into the cache.
	 *
	 * @throws Exception   If there was an error.
	 *
	 * @return void
	 */
	public static function generateLanguageXmlFiles()
	{
		// List of the applets [directory => applet_id].
		$applets = array(
			'memberapplet' => 'JSM2_MemberApplet',
		);

		echo "\nGetting applet language XMLs..\n";

		foreach ($applets as $appletDirectory => $appletLanguageId) {
			echo " Getting > $appletLanguageId ($appletDirectory) language xmls..\n";

			$languages = self::getLanguages($appletLanguageId);
			Language::validate($languages, $appletLanguageId);
			self::saveLanguages($languages, $appletLanguageId);

			echo " < $appletLanguageId ($appletDirectory) language xml cached.\n";
		}

		echo "\nApplet language XMLs generated.\n";
	}

	/**
	 * Gets the available languages for the given applet.
	 *
	 * @param string $applet   The applet identifier.
	 *
	 * @return array   The list of the available applet languages.
	 */
	protected static function getLanguages($applet)
	{
		$result = self::callLanguageApi($applet);

		try {
            API::checkForErrorResult($result);
		}
		catch (\Exception $e) {
			throw new \Exception('Getting languages for applet (' . $applet . ') was unsuccessful ' . $e->getMessage());
		}

		return $result['data'];
	}

	protected static function getLanguageFile($applet, $language)
	{
		$result = self::callLanguageApi($applet, $language);

		try {
			API::checkForErrorResult($result);
		}
		catch (\Exception $e) {
			throw new \Exception('Getting language xml for applet: (' . $applet . ') on language: (' . $language . ') was unsuccessful: '
				. $e->getMessage());
		}

		return $result['data'];
	}

	public static function callLanguageApi($applet, $language = null)
	{
		if($language != null){
			return ApiCall::call(
				'system_api',
				'language_api',
				array(
					'system' => 'LanguageFiles',
					'action' => 'getAppletLanguageFile'
				),
				array(
					'applet' => $applet,
					'language' => $language
				),
				$appletAndArray = array(
					'applet' => $applet,
					'language' => $language
				)
			);
		} else {
		return ApiCall::call(
				'system_api',
				'language_api',
				array(
					'system' => 'LanguageFiles',
					'action' => 'getAppletLanguages'
				),
				array('applet' => $applet)
			);
		}
	}

	public static function saveLanguages($languages, $appletLanguageId)
	{
		$path = Config::get('system.paths.root') . '/cache/flash';

		foreach ($languages as $language) {
				$xmlContent = self::getLanguageFile($appletLanguageId, $language);
				$xmlFile    = $path . '/lang_' . $language . '.xml';
				if (strlen($xmlContent) == file_put_contents($xmlFile, $xmlContent)) {
					echo " OK saving $xmlFile was successful.\n";
				}
				else {
					throw new \Exception('Unable to save applet: (' . $appletLanguageId . ') language: (' . $language
						. ') xml (' . $xmlFile . ')!');
				}
		}
	}
}