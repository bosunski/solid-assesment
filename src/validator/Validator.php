<?php

namespace Language\Validator;

use Language\Results;

class Validator
{
    public static function validateResult($result, $errorMessage)
    {
        try {
			Results::checkForApiErrorResult($result);
		}
		catch (\Exception $e) {
			throw new \Exception($errorMessage . ' '
				. $e->getMessage());
		}
	}
	
	
	public static function validateXmlContent($xmlContent, $xmlFile)
	{
		if (strlen($xmlContent) == file_put_contents($xmlFile, $xmlContent)) 
		{
			echo " OK saving $xmlFile was successful.\n";
		}
		else {
			throw new \Exception('Unable to save applet: (' . $appletLanguageId . ') language: (' . $language
				. ') xml (' . $xmlFile . ')!');
		}
	}

	public static function validateLanguages($languages)
	{
		if (empty($languages)) 
		{
			throw new \Exception('There is no available languages for the ' . $appletLanguageId . ' applet.');
		}
		else {
			echo ' - Available languages: ' . implode(', ', $languages) . "\n";
		}
	}
}