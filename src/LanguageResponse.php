<?php

namespace Language;

class LanguageResponse
{
    public static function languageResponse($language)
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