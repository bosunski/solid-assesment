<?php

namespace Language;

use Language\FormatAsResult;

class ApiCall
{

	public function __construct(Results $results)
	{
		$this->results = $results;
	}

	const GET_LANGUAGE_FILE_RESULT = "<?php
		return array (
			'Models' => 'User Model',
		);";

	const GET_APPLET_LANGUAGE_FILE_RESULT = '<?xml version="1.0" encoding="UTF-8"?>
		<data>
			<status_info value="Sleeping at Home!"/>
		</data>';

	public static function call($target, $mode, $getParameters, $postParameters)
	{
		if (!isset($getParameters['action']))
		{
			return;
		}

		switch ($getParameters['action'])
		{
			case 'getLanguageFile':
				return self::formatAsResult(self::GET_LANGUAGE_FILE_RESULT);
				break;

			case 'getAppletLanguages':
				return self::formatAsResult(['en']);
				break;

			case 'getAppletLanguageFile':
				return self::formatAsResult(self::GET_APPLET_LANGUAGE_FILE_RESULT);
				break;
		}
	}

	public static function formatAsResult($data)
	{
		return [
			'status' => 'OK',
			'data'   => $data,
		];
	}
}
