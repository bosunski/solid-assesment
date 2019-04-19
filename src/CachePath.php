<?php 

namespace Language;

/**
 * 
 */
class CachePath
{
	protected static function getLanguageCachePath($application)
	{
		return Config::get('system.paths.root') . '/cache/' . $application. '/';
	}
}