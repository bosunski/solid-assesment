<?php

namespace Language;

class AppletLanguages
{

	public function __construct(Results $results)
	{
		$this->results = $results;
	}

    public function generateAppletLanguageXmlFiles()
	{
		// List of the applets [directory => applet_id].
		$applets = array(
			'memberapplet' => 'JSM2_MemberApplet',
		);

		echo "\nGetting applet language XMLs..\n";

		foreach ($applets as $appletDirectory => $appletLanguageId) 
		{
			echo " Getting > $appletLanguageId ($appletDirectory) language xmls..\n";

			$languages = $this->getAppletLanguages($appletLanguageId);

			if (empty($languages)) 
			{
				throw new \Exception('There is no available languages for the ' . $appletLanguageId . ' applet.');
			}
			else {
				echo ' - Available languages: ' . implode(', ', $languages) . "\n";
			}

			$path = Config::get('system.paths.root') . '/cache/flash';

			foreach ($languages as $language) 
			{
				$xmlContent = self::getAppletLanguageFile($appletLanguageId, $language);

				$xmlFile    = $path . '/lang_' . $language . '.xml';

				if (strlen($xmlContent) == file_put_contents($xmlFile, $xmlContent)) 
				{
					echo " OK saving $xmlFile was successful.\n";
				}
				else {
					throw new \Exception('Unable to save applet: (' . $appletLanguageId . ') language: (' . $language
						. ') xml (' . $xmlFile . ')!');
				}
			}
			echo " < $appletLanguageId ($appletDirectory) language xml cached.\n";
		}

		echo "\nApplet language XMLs generated.\n";
	}


	public function getAppletLanguages($applet)
	{
		$result = ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'LanguageFiles',
				'action' => 'getAppletLanguages'
			),
			array('applet' => $applet)
		);

		try 
		{
			$this->results->checkForApiErrorResult($result);
		}
		catch (\Exception $e) 
		{
			throw new \Exception('Getting languages for applet (' . $applet . ') was unsuccessful ' . $e->getMessage());
		}

		return $result['data'];
	}


	protected function getAppletLanguageFile($applet, $language)
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
			$this->results->checkForApiErrorResult($result);
		}
		catch (\Exception $e) {
			throw new \Exception('Getting language xml for applet: (' . $applet . ') on language: (' . $language . ') was unsuccessful: '
				. $e->getMessage());
		}

		return $result['data'];
	}
}