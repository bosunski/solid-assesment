<?php

namespace Language;

class Response
{
    public static function languageResponse($action, $language)
    {
        return ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'LanguageFiles',
				'action' => $action
			),
			array('language' => $language)
		);
	}

	public static function appletLanguageResponse($action, $language, $applet)
	{
		return ApiCall::call(
			'system_api',
			'language_api',
			array(
				'system' => 'languageFiles',
				'action' => $action
			),
			array(
				'language' => $language,
				'applet' => $applet
			)
			);
	}
}