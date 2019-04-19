<?php

namespace Language;

class Cache
{
    public static function getLanguageCachePath($application)
	{
		return Config::get('system.paths.root') . '/cache/' . $application. '/';
	}
}