<?php

namespace Language;

class LanguageCache
{

    public static function getLanguageCachePath($application)
	{
		return Config::get('system.paths.root') . '/cache/' . $application. '/';
	}

}