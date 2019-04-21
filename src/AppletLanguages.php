<?php

namespace Language;

class AppletLanguages
{

    public static function generateAppletLanguageXmlFiles()
	{
		// List of the applets [directory => applet_id].
		$applets = array(
			'memberapplet' => 'JSM2_MemberApplet',
		);

		echo "\nGetting applet language XMLs..\n";

		self::appletsLoop($applets);

		echo "\nApplet language XMLs generated.\n";
	}


	public static function getAppletLanguages($applet)
	{
		$result = Response::appletLanguageResponse('getAppletLanguages', 'en', $applet);

		Validator\Validator::validateResult($result, 'Getting languages for applet was unsuccessful');

		return $result['data'];
	}


	protected static function getAppletLanguageFile($applet, $language)
	{
		$result = Response::appletLanguageResponse('getAppletLanguageFile', $language, $applet);

		Validator\Validator::validateResult($result, 'Getting language xml for applet was unsuccessful:');

		return $result['data'];
	}


	protected static function languageLoop($languages, $appletLanguageId, $path)
	{
		foreach ($languages as $language) 
		{
			$xmlContent = self::getAppletLanguageFile($appletLanguageId, $language);

			$xmlFile = self::path($path, $language);

			Validator\Validator::validateXmlContent($xmlContent, $xmlFile, 'Unable to save applet language!');
		}
	}


	public static function appletsLoop($applets)
	{
		foreach ($applets as $appletDirectory => $appletLanguageId) 
		{
			echo " Getting > $appletLanguageId ($appletDirectory) language xmls..\n";

			$languages = self::getAppletLanguages($appletLanguageId);

			Validator\validator::validateLanguages($languages);

			$path = Config::get('system.paths.root') . '/cache/flash';

			self::languageLoop($languages, $appletLanguageId, $path);
			
			echo " < $appletLanguageId ($appletDirectory) language xml cached.\n";
		}
	}


	protected static function path($path, $language)
	{
		return $path . '/lang_' . $language . '.xml';
	}
}