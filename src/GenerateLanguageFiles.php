<?php

namespace Language;

class GenerateLanguageFiles
{

    public function generateLanguageFiles()
    {
        // The applications where we need to translate.
		self::$applications = Config::get('system.translated_applications');

		echo "\nGenerating language files\n";
		foreach (self::$applications as $application => $languages) {
			echo "[APPLICATION: " . $application . "]\n";
			foreach ($languages as $language) {
				echo "\t[LANGUAGE: " . $language . "]";
				if (self::getLanguageFile($application, $language)) {
					echo " OK\n";
				}
				else {
					throw new \Exception('Unable to generate language file!');
				}
			}
		}
    }

}