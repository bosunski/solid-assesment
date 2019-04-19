<?php

namespace Language\Validators;


class Language
{
   public function validate($languages, $appletLanguageId)
   {
	   if (empty($languages)) {
				throw new \Exception('There is no available languages for the ' . $appletLanguageId . ' applet.');
			}
			else {
				echo ' - Available languages: ' . implode(', ', $languages) . "\n";
			}
   }	
}